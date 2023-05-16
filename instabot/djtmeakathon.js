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
    id: "",
    name: "Management",
    host: 18,
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "",
    host: 30,
    name: "IT",
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "",
    host: 40,
    name: "Teacher",
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
  {
    id: "",
    host: 24,
    name: "Doctor",
    port: [
      {
        switch: "",
        switchport: []
      }
    ]
  },
];


// Print the updated VLAN array

var swt_num = 0;
var sum_host = 0;
var numCount = 10;
vlan.forEach((value, index) => {
  sum_host += value.host;
  value.id = "vlan" + numCount.toString();
  numCount++;
});

console.log("Sum host: ", sum_host);
accSwt_num = Math.ceil((sum_host + 24) / 24);
console.log("access switches: ", accSwt_num);
distSwt_num = Math.ceil(accSwt_num / 2);   // distribution switch number
console.log("dist swithces: ", distSwt_num);

var port_require = sum_host + distSwt_num * accSwt_num;
var port_have = accSwt_num * 24;
if (port_have - port_require > 24) {
  accSwt_num -= 1;
  distSwt_num = Math.ceil(accSwt_num / 2);
}
console.log("port require: ", port_require);
console.log("port have: ", port_have);

for (var i = 0; i < vlan.length; i++) {
  // Check if the host count is more than 24
  if (vlan[i].host > (24 - distSwt_num)) {
    // Calculate the number of new VLANs needed to accommodate all hosts
    var numNewVlans = Math.ceil(vlan[i].host / (24 - distSwt_num));
    // Create new VLAN objects with 24 hosts each
    for (var j = 1; j <= numNewVlans; j++) {
      // Calculate the number of hosts for this new VLAN
      var newHostCount = Math.min(vlan[i].host - ((j - 1) * (24 - distSwt_num)), (24 - distSwt_num));
      // Create the new VLAN object and add it to the array
      vlan.push({
        id: vlan[i].id,
        host: newHostCount,
        name: vlan[i].name
      });
    }
    // Remove the original VLAN object from the array
    vlan.splice(i, 1);
    i--;
  }
}
vlan = vlan.sort((obj1, obj2) => obj2.host - obj1.host);
console.log(vlan)

var coreSwt_num = Math.ceil(distSwt_num / 3); //Calculate number of core switch
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
for (let i = 0; i < accSwt_num; i++) {
  accessDevice.push(new deviceObject("accessSwt" + i, "Access Switch " + i, "access"));
  definePort(accessDevice[i], 24, "Gi");
}
for (let i = 0; i < distSwt_num; i++) {
  distDevice.push(new deviceObject("distSwt" + i, "Distribution Switch " + i, "distribution"));
  definePort(distDevice[i], 24, "Gi");
}
for (let i = 0; i < coreSwt_num; i++) {
  coreDevice.push(new deviceObject("coreSwt" + i, "Core Switch " + i, "core"));
  definePort(coreDevice[i], 24, "Gi");
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
    if (VLAN.host <= 24 - accessDevice[access].connected) {
      for (let i = 0; i < VLAN.host; i++) {
        for (let port in accessDevice[access].switchPorts) {
          if (accessDevice[access].switchPorts[port] == false) {
            console.log(accessDevice[access].data.id);
            VLAN.port[0].switch = String(accessDevice[access].data.id);
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

vlan.forEach((VLAN, index) => {
  var labelTarget = "";
  var startPort = "";
  var endPort = "";
  for (let accdv in accessDevice) {
    if (VLAN.port[0].switch == accessDevice[accdv].data.id) {
      startPort = Object.keys(accessDevice[accdv].switchPorts)[VLAN.port[0].switchport[0]];
      for (let i = 0; i < VLAN.port[0].switchport.length; i++) {
        if (VLAN.port[0].switchport[i] + 1 == VLAN.port[0].switchport[i + 1]) {
          endPort = Object.keys(accessDevice[accdv].switchPorts)[VLAN.port[0].switchport[i + 1]];
        } else {
          if (endPort == "") {
            labelTarget = labelTarget + startPort + ",";
          } else {
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

