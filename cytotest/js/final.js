class deviceObject {
  constructor(id, label, layer) {
    this.data = {
      id: id,
      label: label,
      layer: layer
    },
      this.switchPorts = {
      },
      this.connected = 0;
  }
}

class portObject {
  constructor(source, target, sourceLabel, targetLabel) {
    this.data = {
      id: source.id + "-" + target.id,
      source: source.id,
      target: target.id
    }
    this.style = {
      sourceLabel: sourceLabel,
      targetLabel: targetLabel
    }
  }
}

var vlan = [
  {
    id: "Management",
    host: 18,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "IT",
    host: 20,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "Student",
    host: 30,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "Teacher",
    host: 32,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "CSGO",
    host: 25,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "Cum Thanh",
    host: 40,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
];
// var vlan = [
//   {
//     "id": "Management", "host": 63, "port": [{
//       "switch": "", "switchport": []
//     }
//     ]
//   },
//   {
//     "id": "IT",
//     "host": 47,
//     "port": [
//       {
//         "switch": "",
//         "switchport": []
//       }
//     ]
//   },
//   {
//     "id": "Student",
//     "host": 70,
//     "port": [
//       {
//         "switch": "",
//         "switchport": []
//       }
//     ]
//   },
//   {
//     "id": "Teacher",
//     "host": 19,
//     "port": [
//       {
//         "switch": "",
//         "switchport": []
//       }
//     ]
//   },
//   {
//     "id": "CSGO",
//     "host": 43,
//     "port": [
//       {
//         "switch": "",
//         "switchport": []
//       }
//     ]
//   },
//   {
//     "id": "Cum Thanh",
//     "host": 27,
//     "port": [
//       {
//         "switch": "",
//         "switchport": []
//       }
//     ]
//   },
//   {
//     "id": "Marketing",
//     "host": 86,
//     "port": [
//       {
//         "switch": "",
//         "switchport": []
//       }
//     ]
//   }
// ];


/*Step 1: Calculate switches of each layers from input vlan, assign port for switches */

var swt_num = 0;
var sum_host = 0;
vlan.forEach((value, index) => {
  sum_host += value.host;                       // Calculate total host to determine further access switches number
});

console.log("Sum host: ", sum_host);
accSwt_num = Math.ceil((sum_host + 48) / 48);   // Each access switch has 48 ports
console.log("access switches: ", accSwt_num);
distSwt_num = Math.ceil(accSwt_num / 2);        // distribution switch number = Access switches / 2
console.log("dist switches: ", distSwt_num);


var port_require = sum_host + distSwt_num * accSwt_num;   //
var port_have = accSwt_num * (48 - distSwt_num);

if (port_have - port_require > 48) {
  accSwt_num -= 1;
  distSwt_num = Math.ceil(accSwt_num / 2);
}

console.log("port require: ", port_require);
console.log("port have: ", port_have);

/* Separate "big" vlan into small ones, each vlan have host = avaiable ports in 1 switch after minus ports for upper layer. */

for (var i = 0; i < vlan.length; i++) {
  // Check if the host count is more than 48
  if (vlan[i].host > (48 - distSwt_num)) {
    // Calculate the number of new VLANs needed to accommodate all hosts
    var numNewVlans = Math.ceil(vlan[i].host / (48 - distSwt_num));
    // Create new VLAN objects with 24 hosts each
    for (var j = 1; j <= numNewVlans; j++) {
      // Calculate the number of hosts for this new VLAN
      var newHostCount = Math.min(vlan[i].host - ((j - 1) * (48 - distSwt_num)), (48 - distSwt_num));
      // Create the new VLAN object and add it to the array
      vlan.push({
        id: vlan[i].id + " " + String(j),
        host: newHostCount,
        port: [
          {
            switch: "",
            switchport: []
          }
        ]
      });
    }
    // Remove the original VLAN object from the array
    vlan.splice(i, 1);
    i--;
  }
}

/*----------------------------------------------------------------------------------------------------------------------*/

vlan = vlan.sort((obj1, obj2) => obj2.host - obj1.host);  // Sort vlan from largest to smallest.
console.log(vlan)
var coreSwt_num = Math.ceil(distSwt_num / 3);   //Calculate number of core switch.
var coreDevice = [];
var distDevice = [];
var accessDevice = [];

/* Define ports for switch */
function definePort(source, numPort, typePort) {
  counter = 1;
  octet = 0;
  for (let i = 1; i <= numPort; i++) // The number depend on number of ports which is fetched from database.100px
  {
    if (counter > 24) {
      octet++;
      counter = 1;
    }
    portLabel = typePort + "1/" + octet + "/" + counter;  // Each 24 ports increase octet by 1. Example 0/0/24 -> 1/0/1.
    counter++;
    source.switchPorts[portLabel] = false;
    /* Output should be Gi0/0/1 */ 
  }
}
/*
Loop to assign port to each vlan
 */
for (let i = 0; i < accSwt_num; i++) {
  accessDevice.push(new deviceObject("accessSwt" + i, "Access Switch " + i, "access"));
  definePort(accessDevice[i], 48, "Gi");
}
for (let i = 0; i < distSwt_num; i++) {
  distDevice.push(new deviceObject("distSwt" + i, "Distribution Switch " + i, "distribution"));
  definePort(distDevice[i], 48, "Gi");
}
for (let i = 0; i < coreSwt_num; i++) {
  coreDevice.push(new deviceObject("coreSwt" + i, "Core Switch " + i, "core"));
  definePort(coreDevice[i], 48, "Gi");
}
/*-----------------------------------------------------*

/*Step 2: Create array of ports and devices */
/* 
We prioritize upper layer than lower, so connection from upper layer is priority, then we work from core layer to distribution layer first 
First connect ports from core to dist
*/
var portDevice = [];
for (let core in coreDevice) {
  for (let dist in distDevice) {
    for (let portSource in coreDevice[core].switchPorts) {
      if (coreDevice[core].switchPorts[portSource] == false) {
        portTarget = Object.keys(distDevice[dist].switchPorts)[Object.keys(coreDevice[core].switchPorts).indexOf(portSource)];
        if (distDevice[dist].switchPorts[portTarget] == false) {
          portDevice.push(new portObject(coreDevice[core].data, distDevice[dist].data, portSource, portTarget));
          coreDevice[core].switchPorts[portSource] = true;
          coreDevice[core].connected++;
          distDevice[dist].switchPorts[portTarget] = true;
          distDevice[dist].connected++;
          break;
        }
      }
    }
  }
}
/*---------------------------------------------------------------------------------------------------------------- */
// Then connect ports from dist to access
for (let dist in distDevice) {
  for (let access in accessDevice) {
    for (let portSource in distDevice[dist].switchPorts) {
      if (distDevice[dist].switchPorts[portSource] == false) {
        portTarget = Object.keys(accessDevice[access].switchPorts)[Object.keys(distDevice[dist].switchPorts).indexOf(portSource)];
        if (accessDevice[access].switchPorts[portTarget] == false) {
          portDevice.push(new portObject(distDevice[dist].data, accessDevice[access].data, portSource, portTarget));
          distDevice[dist].switchPorts[portSource] = true;
          distDevice[dist].connected++;
          accessDevice[access].switchPorts[portTarget] = true;
          accessDevice[access].connected++;
          break;
        }
      }
    }
  }
}
// Then connect ports from access to vlan
vlan.forEach((VLAN) => {
  check = false;
  for (let access in accessDevice) {
    if (VLAN.host <= 48 - accessDevice[access].connected) { // Check if avaiable ports > host
      for (let i = 0; i < VLAN.host; i++) {
        for (let port in accessDevice[access].switchPorts) {
          if (accessDevice[access].switchPorts[port] == false) {
            console.log(accessDevice[access].data.id);
            VLAN.port[0].switch = String(accessDevice[access].data.id);
            portIndex = Object.keys(accessDevice[access].switchPorts).indexOf(port);
            VLAN.port[0].switchport.push(portIndex); // Save index of port in switch to get Label after
            accessDevice[access].switchPorts[port] = true;
            accessDevice[access].connected++;
            break;
          }
        }
      }
      check = true;
    }
    if (check == true) {
      break;
    }
  }
});
/*--------------------------------------------------------------------------- */

/*Save Label for CYTOSCAPE, get port Label from index saved in vlan variable */
vlan.forEach((VLAN) => {
  var labelTarget = "";
  var startPort = "";
  var endPort = "";
  for (let accdv in accessDevice) {
    if (VLAN.port[0].switch == accessDevice[accdv].data.id) {
      startPort = Object.keys(accessDevice[accdv].switchPorts)[VLAN.port[0].switchport[0]];
      for (let i = 0; i < VLAN.port[0].switchport.length; i++) {  
        if (VLAN.port[0].switchport[i] + 1 == VLAN.port[0].switchport[i + 1]) {
          endPort = Object.keys(accessDevice[accdv].switchPorts)[VLAN.port[0].switchport[i + 1]]; // If nextport = currentport + 1, for example nextport index  = 2 and current port index = 1, save endpoint = nextport
        } else { // if not 
          if (endPort == "") { // if endport = null -> add "," such as [1 -> startport,4,5,6,7]
            labelTarget = labelTarget + startPort + ","; 
          } else {  // if endport != null -> get range port such as [1,2,3,6,7] -> 1 startport, 3 endport, 6 startport, 7 endport
            labelTarget = labelTarget + startPort + "-" + endPort + ",";
          }
          startPort = Object.keys(accessDevice[accdv].switchPorts)[VLAN.port[0].switchport[i + 1]];
          endPort = "";
        }
      }
      portDevice.push(new portObject(accessDevice[accdv].data, VLAN, labelTarget, "Ethernet"));
    }
  }
})

console.log(vlan)
console.log(accessDevice);
console.log(portDevice);




//--------------------------------------------------------



/* CYTOSCAPE SECTION */



//--------------------------------------------------------




var cy = cytoscape({
  container: document.getElementById("cy"), // container to render in, declared in HTML

  wheelSensitivity: 0.1,

  style: [
    // the stylesheet for the graph
    {
      selector: "node",
      style: {
        "background-color": "#666",
        "label": "data(label)",
        "shape": "rectangle",
        "font-size": 10,
        "text-background-opacity": 1,
        "text-background-shape": "rectangle",
        "text-background-color": "black",
        "color": "white",
        "text-valign": "bottom"
      },
    },
    {
      selector: "edge",
      style: {
        "width": 3,
        "line-color": "#aaa",
        "curve-style": "bezier",
        "control-point-step-size": 80, // change this value to adjust the curve
        "line-style": "dashed",
        "line-dash-pattern": [6, 4],
        "font-size": 10,
        "text-wrap": "wrap",
        "text-max-width": "100px",
        "source-text-offset": "50px",
        "target-text-offset": "10px",
        "source-text-margin-y": "-10px",
        "target-text-margin-y": "-10px",
        "text-opacity": 0,
        "text-background-opacity": 1,
        "text-background-color": "black",
        "color": "yellow",
      },
    },
  ],
});

vlan.forEach(VLAN => {
  cy.add({
    data: { id: VLAN.id, label: VLAN.id },
    style: {
      "background-image": "./images/pc.png",
      "background-fit": "contain",
      "background-opacity": "0",
    }
  })
});

cy.add([{ data: { id: "router", label: "Router" } }]);

for (let i = 0; i < coreDevice.length; i++) {
  cy.add({
    data: coreDevice[i].data
  });
};

for (let i = 0; i < distDevice.length; i++) {
  cy.add({
    data: distDevice[i].data
  });
};

for (let i = 0; i < accessDevice.length; i++) {
  cy.add({
    data: accessDevice[i].data
  });
};

cy.nodes('[layer="core"]').forEach(function (core) {
  cy.add({
    data: {
      id: core.id() + "-" + "router", // unique id for the edge
      source: "router", // set the source to the id of the "Router" node
      target: core.id(), // set the target to the id of the current core node
    },
    style: {
      "line-style": "solid",
      "sourceLabel": "G0/0/1",
      "targetLabel": "G1/0/11",
    }
  });
});

for (let i = 0; i < portDevice.length; i++) {
  cy.add(
    {
      data: portDevice[i].data, style: portDevice[i].style
    },
  );
};

cy.nodes('[layer="core"]').style({
  "background-image": "./images/3650.png",
  "background-fit": "contain",
  "background-opacity": "0",
});

cy.nodes('[layer="distribution"]').style({
  "background-image": "./images/3650.png",
  "background-fit": "contain",
  "background-opacity": "0",
});

cy.nodes('[layer="access"]').style({
  "background-image": "./images/sw.png",
  "background-fit": "contain",
  "background-opacity": "0",
});

cy.nodes('[id="router"]').style({
  "background-image": "./images/router.png",
  "background-fit": "contain",
  "background-opacity": "0",
});

cy.on("select unselect", "edge", function (evt) {
  evt.target.style("text-opacity", evt.target.selected() ? 1 : 0);
  evt.target.style("line-color", evt.target.selected() ? "red" : "#aaa");
  evt.target.style("z-index", evt.target.selected() ? "3" : "1");
});

cy.on("tap", function (event) {
  if (event.target === cy) {
    cy.elements().style("line-color", "#aaa"); // reset line color of all edges
    cy.elements().style("z-index", "1");
  }
});

cy.nodes().on("tap", function (event) {
  var clickedNode = event.target;
  var connectedEdges = cy.elements().edgesWith(clickedNode);

  cy.elements().style("line-color", "#aaa"); // reset line color of all edges
  setTimeout(function () {
    connectedEdges.style("line-color", "black"); // highlight the edges connected to the clicked node
    connectedEdges.style("z-index", "3");
  }, 50);
});

var layout = cy.layout({
  name: "dagre",
  rankDir: "TB", // top to bottom
  rankSep: 150,
  nodeSep: 150,
});

layout.run();


