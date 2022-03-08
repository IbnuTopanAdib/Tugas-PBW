const n = parseInt(prompt('Masukan jumlah deret: '));
let n1 = 0, n2 = 1, nextTerm;

console.log('Deret Fibonacci:');

for (let i = 1; i <= n; i++) {
    console.log(n1);
    nextTerm = n1 + n2;
    n1 = n2;
    n2 = nextTerm;
}