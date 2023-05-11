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
    host: 30,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "Student",
    host: 40,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "Teacher",
    host: 24,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
];

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
        id: vlan[i].id,
        host: newHostCount
      });
    }
    // Remove the original VLAN object from the array
    vlan.splice(i, 1);
    i--;
  }
}

// Print the updated VLAN array
console.log(vlan);
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
          swtch.port[j] = vlanItem.id;
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



var dist_num = Math.ceil(swt_num / 3); //Calculate number of distribution switch
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
vlan.forEach((VLAN) => {
  var labelTarget = "";
  var startPort = "";
  var endPort = "";
  for (let accdv in accessDevice) {
    if (VLAN.port[0].switch == accessDevice[accdv].data.id) {
      startPort = Object.keys(accessDevice[accdv].switchPorts)[0];
      for (let i = 0; i < VLAN.port[0].switchport.length; i++) {
        if (VLAN.port[0].switchport[i] + 1 == VLAN.port[0].switchport[i + 1]) {
          endPort = Object.keys(accessDevice[accdv].switchPorts)[i + 1];
        } else {
          if (endPort == "") {
            labelTarget = labelTarget + startPort + ",";
          } else {
            labelTarget = labelTarget + startPort + "-" + endPort + ",";
          }
          startPort = Object.keys(accessDevice[accdv].switchPorts)[i + 1];
          endPort = "";
        }
      }
      portDevice.push(new portObject(accessDevice[accdv].data, VLAN, labelTarget, "Ethernet"));
    }
  }
})

// for (let i = 0; i < VLAN.port[0].switchport.length; i++) {
//   if (VLAN.port[0].switchport[i] + 1 == VLAN.port[0].switchport[i + 1]) {
//     endPort = VLAN.port[0].switchport[i + 1].toString();

//   } else {
//     if (endPort == null) {
//       labelTarget = labelTarget + startPort.toString() + ",";
//     } else {
//       labelTarget = startPort.toString() + "-" + endPort + ",";
//     }
//     startPort = VLAN.port[0].switchport[i + 1];
//     endPort = "";
//   }
//   if (i == VLAN.port[0].switchport.length - 1) {
//     labelTarget = startPort + "-" + endPort + ",";
//   }
// }
// console.log(labelTarget);
console.log(swt);
console.log(accessDevice);
console.log(portDevice);