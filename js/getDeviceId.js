// JavaScript Document
function getMachineId() {

    let machineId = localStorage.getItem('MachineId');

    if (!machineId) {
        machineId = crypto.randomUUID();
        localStorage.setItem('MachineId', machineId);
    }
    document.getElementById('deviceid').value = machineId;
    return machineId;
}