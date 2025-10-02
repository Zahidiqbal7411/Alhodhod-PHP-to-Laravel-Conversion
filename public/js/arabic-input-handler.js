 // Arabic text detection and RTL switching
 document.addEventListener('DOMContentLoaded', function() {
    const arabicInput = document.getElementById('page_ar');
    
    // Function to detect Arabic characters
    function isArabic(text) {
        const arabicRegex = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDFF\uFE70-\uFEFF]/;
        return arabicRegex.test(text);
    }
    
    // Function to switch text direction
    function switchDirection(input) {
        const text = input.value;
        if (text.length > 0) {
            if (isArabic(text)) {
                input.style.direction = 'rtl';
                input.style.textAlign = 'right';
            } else {
                input.style.direction = 'ltr';
                input.style.textAlign = 'left';
            }
        } else {
            // If empty, keep RTL for Arabic input
            input.style.direction = 'rtl';
            input.style.textAlign = 'right';
        }
    }
    
    // Set initial RTL direction for Arabic input
    arabicInput.style.direction = 'rtl';
    arabicInput.style.textAlign = 'right';
    
    // Listen for input changes
    arabicInput.addEventListener('input', function() {
        switchDirection(this);
    });
    
    // Listen for keyup events (for real-time detection)
    arabicInput.addEventListener('keyup', function() {
        switchDirection(this);
    });
    
    // Check on focus
    arabicInput.addEventListener('focus', function() {
        switchDirection(this);
    });
    
    // Check on blur
    arabicInput.addEventListener('blur', function() {
        switchDirection(this);
    });
});
