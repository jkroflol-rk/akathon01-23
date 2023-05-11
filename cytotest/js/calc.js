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
    "name": "Management",
    "host": 18,
    "port": [
      {
        "switch": "", 
        "switchport": []
      }
    ]
  },
  {
    "name": "Student",
    "host": 20,
    "port": [
      {
        "switch": "",
        "switchport": []
      }
    ]
  },
  {
    "name": "IT",
    "host": 30,
    "port": [
      {
        "switch": "",
        "switchport": []
      }
    ]
  },
  {
    "name": "CSGO",
    "host": 32,
    "port": [
      {
        "switch": "",
        "switchport": []
      }
    ]
  },
  {
    "name": "CS2",
    "host": 25,
    "port": [
      {
        "switch": "",
        "switchport": []
      }
    ]
  },
  {
    "name": "Van Dai",
    "host": 40,
    "port": [
      {
        "switch": "",
        "switchport": []
      }
    ]
  },
  {
    "name": "Cum Thanh",
    "host": 22,
    "port": [
      {
        "switch": "",
        "switchport": []
      }
    ]
  }
]


for (var i = 0; i < vlan.length; i++) {
  // Check if the host count is more than 48
  if (vlan[i].host > 48) {
    // Calculate the number of new VLANs needed to accommodate all hosts
    var numNewVlans = Math.ceil(vlan[i].host / 48);
    // Create new VLAN objects with 24 hosts each
    for (var j = 1; j <= numNewVlans; j++) {
      // Calculate the number of hosts for this new VLAN
      var newHostCount = Math.min(vlan[i].host - ((j - 1) * 48), 48);
      // Create the new VLAN object and add it to the array
      vlan.push({
        name: vlan[i].name,
        host: newHostCount
      });
    }
    // Remove the original VLAN object from the array
    vlan.splice(i, 1);
    i--;
  }
}

// Print the updated VLAN array
vlan = vlan.sort((obj1, obj2) => obj2.host - obj1.host);

var sum_host = 0;
var swt_num = 0;
vlan.forEach((element, index) => {
  sum_host += element.host;
});
// switch numbers should be round up such as 3.14 to 4
swt_num = Math.ceil(sum_host / 48);

const myArray = new Array(48).fill(null);
const swt = [];
for (let i = 0; i < swt_num; i++) {
  swt.push({ connected: 0, port: [...myArray] });
}

vlan.forEach((vlanItem) => {
  let assigned = false;
  let numSwitches = swt.length;
  while (!assigned && numSwitches <= swt_num) {
    for (let i = 0; i < numSwitches; i++) {
      const swtch = swt[i];
      if (vlanItem.host <= 48 - swtch.connected) {
        for (let j = swtch.connected; j < swtch.connected + vlanItem.host; j++) {
          swtch.port[j] = vlanItem.name;
        }
        swtch.connected += vlanItem.host;
        assigned = true;
        break; // exit loop over switches
      }
    }
    if (!assigned) {
      swt.push({ connected: 0, port: [...myArray] });
      numSwitches++;
      swt_num++;
    }
  }
});



var dist_num = Math.ceil(swt_num / 2); //Calculate number of distribution switch
var core_num = Math.ceil(dist_num / 3); //Calculate number of core switch
var coreDevice = [];
var distDevice = [];
var accessDevice = [];

function definePort(source, numPort, typePort) {
  counter = 1;
  octet = 0;
  for (let i = 1; i <= numPort; i++) // The number depend on number of ports which is fetched from database
  {
    if (counter > 24) {
      octet++;
      counter = 1;
    }
    portLabel = typePort + "1/" + octet + "/" + counter;
    counter++;
    source.switchPorts[portLabel] = false;
  }
}
/*
Define Switch by layer in devices variable, switches must be defined before calculate port since 
we have to collect id of devices between 2 layers.
 */
for (let i = 0; i < swt_num; i++) {
  accessDevice.push(new deviceObject("accessSwt" + i, "Access Switch " + i, "access"));
  definePort(accessDevice[i], 48, "Gi");
}
for (let i = 0; i < dist_num; i++) {
  distDevice.push(new deviceObject("distSwt" + i, "Distribution Switch " + i, "distribution"));
  definePort(distDevice[i], 48, "Gi");
}
for (let i = 0; i < core_num; i++) {
  coreDevice.push(new deviceObject("coreSwt" + i, "Core Switch " + i, "core"));
  definePort(coreDevice[i], 48, "Gi");
}
/*-----------------------------------------------------*/



/* 
We prioritize upper layer than lower, so connection from upper layer is priority, then we work from core layer to distribution layer first 
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

vlan.forEach((VLAN) => {
  check = false;
  for (let access in accessDevice) {
    if (VLAN.host <= 48 - accessDevice[access].connected) {
      for (let i = 0; i < VLAN.host; i++) {
        for (let port in accessDevice[access].switchPorts) {
          if (accessDevice[access].switchPorts[port] == false) {
            VLAN.port[0].switch = accessDevice[access].data.id;
            console.log(VLAN.port[0].switch);
            portIndex = Object.keys(accessDevice[access].switchPorts).indexOf(port);
            VLAN.port[0].switchport.push(portIndex);
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

console.log(vlan);

console.log(portDevice);
console.log(coreDevice);
console.log(accessDevice);
console.log(distDevice);

var cy = cytoscape({
  container: document.getElementById("cy"), // container to render in

  wheelSensitivity: 0.1,

  style: [
    // the stylesheet for the graph
    {
      selector: "node",
      style: {
        "background-color": "#666",
        label: "data(label)",
        shape: "rectangle",
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
        width: 2,
        "line-color": "#444",
        "curve-style": "bezier",
        "control-point-step-size": 80, // change this value to adjust the curve
        "line-style": "dashed",
        "line-dash-pattern": [6, 4],
        "font-size": 10,
        "text-wrap": "wrap",
        "text-max-width": "100px",
        "source-text-offset": "30px",
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
      "sourceLabel":"G0/0/1",
      "targetLabel":"G1/0/11",
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
  evt.target.style("line-color", evt.target.selected() ? "#1ca3ec" : "#444");
  evt.target.style("z-index", evt.target.selected() ? "3" : "1");
});

cy.on("tap", function (event) {
  if (event.target === cy) {
    cy.elements().style("line-color", "#444"); // reset line color of all edges
  }
});

cy.nodes().on("tap", function (event) {
  var clickedNode = event.target;
  var connectedEdges = cy.elements().edgesWith(clickedNode);

  cy.elements().style("line-color", "#444"); // reset line color of all edges
  setTimeout(function () {
    connectedEdges.style("line-color", "red"); // highlight the edges connected to the clicked node
  }, 50);
});

var layout = cy.layout({
  name: "dagre",
  rankDir: "TB", // top to bottom
  rankSep: 120,
  nodeSep: 120,
});

layout.run();




