// 1
const age = parseInt(prompt("Quel est votre age?"));
console.log(typeof age);
console.log(age);
const year = parseInt(prompt("Donnez une année dans le futur?"));
alert(`En ${year} tu auras ${age + year - 2021} ans`);
alert(`Tu es né en ${2021 - age}`);
