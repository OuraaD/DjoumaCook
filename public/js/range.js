document.addEventListener('DOMContentLoaded', (event) => {
    const slider = document.querySelector('#recipe_difficulty');
    const output = document.querySelector('#output-value');
    if (slider && output) {
        slider.addEventListener('input', function () {
            output.textContent = this.value;
        });
    }
});
