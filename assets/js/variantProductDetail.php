<script>
    let selectedVariant = ''; 

function selectVariant(id, type) {
    selectedVariant = id; 
    document.getElementById('variant').value = selectedVariant; 
    highlightSelection(type, id);  
}

function highlightSelection(type, value) {
    let elements = document.querySelectorAll(`.${type}-option`);
    elements.forEach(el => {
        if (el.getAttribute('data-variant-id') === value.toString()) {
            el.style.borderColor = "#fd2424"; 
        } else {
            el.style.borderColor = "#d1d5db"; 
        }
    });
}

</script>
