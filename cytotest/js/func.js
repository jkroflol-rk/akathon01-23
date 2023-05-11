var vlan = [
  {name: "Management", host: 18},
  {name: "Student", host: 20},
  {name: "IT", host: 30},
  {name: "CSGO", host: 32},
  {name: "CS2", host: 25},
  {name: "Van Dai", host: 40}
];

for (var i = 0; i < vlan.length; i++) {
  // Check if the host count is more than 24
  if (vlan[i].host > 48) {
    // Calculate the number of new VLANs needed to accommodate all hosts
    var numNewVlans = Math.ceil(vlan[i].host / 48);
    // Create new VLAN objects with 48 hosts each
    for (var j = 1; j <= numNewVlans; j++) {
      // Calculate the number of hosts for this new VLAN
      var newHostCount = Math.min(vlan[i].host - ((j-1) * 48), 48);
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

console.log(swt);





