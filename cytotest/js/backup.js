// Calculating switch numbers from input vlan and host
// var vlan = [
//   {name: "Management", host: 18},
//   {name: "Student", host: 20},
//   {name: "IT", host: 20},
//   {name: "CSGO", host: 18},
//   {name: "CS2", host: 24},
//   {name: "CS1.6", host: 24},
//   {name: "Van Dai", host: 20}
// ];  

// vlan = vlan.sort((obj1, obj2) => obj2.host - obj1.host);

// var sum_host = 0;
// var swt_num = 0;
// vlan.forEach((element, index) => {
//   sum_host += element.host;
// });
// // switch numbers should be round up such as 3.14 to 4
// swt_num = Math.ceil(sum_host / 24);
 
// const myArray = new Array(24).fill(null);
// const swt = [];
// for (let i = 0; i < swt_num; i++) {
//   swt.push({connected: 0, port: [...myArray]});
// }

// vlan.forEach((vlanItem) => {
//   let assigned = false;
//   let numSwitches = swt.length;
//   while (!assigned && numSwitches <= swt_num) {
//     for (let i = 0; i < numSwitches; i++) {
//       const swtch = swt[i];
//       if (vlanItem.host <= 24 - swtch.connected) {
//         for (let j = swtch.connected; j < swtch.connected + vlanItem.host; j++) {
//           swtch.port[j] = vlanItem.name;
//         }
//         swtch.connected += vlanItem.host;
//         assigned = true;
//         break; // exit loop over switches
//       }
//     }
//     if (!assigned) {
//       swt.push({connected: 0, port: [...myArray]});
//       numSwitches++;
//       swt_num++;
//     }
//   }
// });

// console.log(swt);



// vlan = vlan.sort((obj1, obj2) => obj2.host - obj1.host);

// const myArray = new Array(24).fill(null);
// let swt = [{connected: 0, port: [...myArray]}];

// vlan.forEach((vlanItem) => {
//   let assigned = false;
//   while (!assigned) {
//     const numSwitches = swt.length;

//     for (let i = 0; i < numSwitches; i++) {
//       const swtch = swt[i];
//       if (vlanItem.host <= 24 - swtch.connected) {
//         for (let j = swtch.connected; j < swtch.connected + vlanItem.host; j++) {
//           swtch.port[j] = vlanItem.name;
//         }
//         swtch.connected += vlanItem.host;
//         assigned = true;
//         break; // exit loop over switches
//       }
//     }

//     if (!assigned) {
//       // If no switch has enough available ports, create a new switch
//       const numNewPorts = Math.min(vlanItem.host, 24);
//       const newSwtch = {connected: numNewPorts, port: new Array(numNewPorts).fill(vlanItem.name)};
//       swt.push(newSwtch);

//       if (vlanItem.host > 24) {
//         // If the VLAN requires more than 24 ports, create additional switches as needed
//         for (let i = 24; i < vlanItem.host; i += 24) {
//           const numNewPorts = Math.min(vlanItem.host - i, 24);
//           const newSwtch = {connected: numNewPorts, port: new Array(numNewPorts).fill(vlanItem.name)};
//           swt.push(newSwtch);
//         }
//       }

//       assigned = true;
//     }
//   }
// });

// console.log(swt);