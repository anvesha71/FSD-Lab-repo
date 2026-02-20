const display = document.getElementById("display");
const buttons = document.querySelectorAll("button");

let currentInput = "";

buttons.forEach(button => {
    button.addEventListener("click", () => {
        const value = button.textContent;

        if (value === "CE") {
            currentInput = "";
            display.value = "0";
        } 
        else if (value === "=") {
            try {
                let expression = currentInput
                    .replace(/×/g, "*")
                    .replace(/÷/g, "/");

                let result = eval(expression);
                display.value = result;
                currentInput = result.toString();
            } catch {
                display.value = "Error";
                currentInput = "";
            }
        } 
        else {
            currentInput += value;
            display.value = currentInput;
        }
    });
});