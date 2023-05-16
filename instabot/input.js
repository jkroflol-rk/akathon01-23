var deviceConfig = [];
function GenerateConfigInput(swtDevice, portDevice, vlanDevice) {
    command_line = "";
    deviceIp = 2;
    vlanIp = 2;
    3
    swtDevice.forEach(element => {
        var hostname = element.data.id;
        command_line = "hostname " + hostname + "\n!\n";
        command_line += "no ip domain-lookup \n!\n";
        if (element.data.id.includes("Swt") == true) {
            command_line += "ip default-gateway 192.168.1.1\n!\n"
            command_line += "interface vlan1\n";
            command_line += "ip address 192.168.1." + deviceIp + " 255.255.255.0\n!\n";

        }
        deviceIp++;
        vlanDevice.forEach(elementvlan => {
            if (hostname.includes("Swt") == true) {
                var vlan_name = elementvlan.name;
                command_line += elementvlan.id + "\n";
                command_line += "name " + vlan_name + " \n!\n";
            }
        });
        if (hostname.includes("router") == true) {
            vlanDevice.forEach(vlanElement => {
                command_line += "interface g0/0/1." + vlanElement.id.substring(4, vlanElement.id.length);
                command_line += "encapsulation dot1q " + vlanElement.id.substring(4, vlanElement.id.length);
                command_line += "ip address 192.168." + vlanIp + ".1";

            });
        }
        if (hostname.includes("Swt") == true) {
            portDevice.forEach(portElement => {
                if ((portElement.data.source == hostname) && (portElement.data.target.includes("vlan") == false)) {
                    command_line += "interface range " + portElement.style.sourceLabel + "\n";
                    command_line += "switchport mode trunk \n!\n";
                } else if ((portElement.data.source == hostname) && (portElement.data.target.includes("vlan") == true)) {
                    command_line += "interface range " + portElement.style.sourceLabel + "\n";
                    var switchport = "access ";
                    command_line += "switchport mode " + switchport + "\n";
                    command_line += "switchport access " + portElement.data.target + "\n!\n";
                }
            });
        }
        deviceConfig.push(command_line);
        command_line = "";
    });
    return deviceConfig;
}
command = GenerateConfigInput(accessDevice, portDevice, vlan);
console.log(command);