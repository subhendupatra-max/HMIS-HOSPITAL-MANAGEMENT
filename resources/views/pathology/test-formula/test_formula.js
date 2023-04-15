//==================================== start test_name ====================================
const input = document.getElementById("hemogolobin");
input.addEventListener("keyup", function() {
    document.getElementById('abcd').value = parseFloat(parseFloat( parseFloat(input.value) + 100 )/100);
});
//==================================== end test_name ====================================
