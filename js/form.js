// Form label animations
document.querySelectorAll('.form input, .form textarea').forEach(function(input) {
    input.addEventListener('keyup', function(e) {
        var label = this.previousElementSibling;
        if (this.value === '') {
            label.classList.remove('active', 'highlight');
        } else {
            label.classList.add('active', 'highlight');
        }
    });

    input.addEventListener('blur', function() {
        var label = this.previousElementSibling;
        if (this.value === '') {
            label.classList.remove('active', 'highlight');
        } else {
            label.classList.remove('highlight');
        }
    });

    input.addEventListener('focus', function() {
        var label = this.previousElementSibling;
        if (this.value !== '') {
            label.classList.add('highlight');
        }
    });
});

// Tab switching
document.querySelectorAll('.tab a').forEach(function(tabLink) {
    tabLink.addEventListener('click', function(e) {
        e.preventDefault();

        // Remove active class from all tabs
        var tabs = tabLink.parentElement.parentElement.children;
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove('active');
        }

        // Add active class to clicked tab
        tabLink.parentElement.classList.add('active');

        // Get the target content div
        var target = document.querySelector(tabLink.getAttribute('href'));

        // Hide all tab contents
        var tabContents = document.querySelectorAll('.tab-content > div');
        tabContents.forEach(function(content) {
            content.style.display = 'none';
        });

        // Show the target content
        target.style.display = 'block';
    });
});
