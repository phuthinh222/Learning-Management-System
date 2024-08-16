$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})
document.addEventListener('DOMContentLoaded', () => {
    const filterButton = document.getElementById('filter-button');
    const filterOptions = document.getElementById('filter-options');
    const typeSelect = document.getElementById('type-select');
    const detailSelect = document.getElementById('detail-select');
    var detailOptions =[];

    $.ajax({
        'type': 'GET',
        'url': '/admin/filter/getDetails',
        'dataType': 'JSON',
        success: function(response) {
            var subjects = response.data;
            subjects.forEach(subject => {
                detailOptions.push ({
                    value: subject.id,
                    text: subject.name
                })
            });     
        }
    })
    const options = {
        Student: detailOptions,
        Teacher: detailOptions,
        Employee: [{
                value: 1,
                text: 'Đang làm việc'
            },
            {
                value: 0,
                text: 'Đã nghỉ'
            }
        ]
    };
    
    filterButton.addEventListener('click', () => {
        filterOptions.classList.toggle('show');
        const selectedType = typeSelect.value;
        detailSelect.innerHTML = '<option value="">Chọn chi tiết</option>'; // Reset detail select
        var oldValue = detailSelect ? detailSelect.getAttribute('data-old-value') : null;
        if (selectedType && options[selectedType]) {
            options[selectedType].forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.value;
                optionElement.textContent = option.text;
                detailSelect.appendChild(optionElement);
                if (oldValue == option.value) {
                    optionElement.selected = true;
                }
            });
        }
    });

    typeSelect.addEventListener('change', () => {
        const selectedType = typeSelect.value;
        detailSelect.innerHTML = '<option value="">Chọn chi tiết</option>'; // Reset detail select
        if (selectedType && options[selectedType]) {
            options[selectedType].forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.value;
                optionElement.textContent = option.text;
                detailSelect.appendChild(optionElement);

            });
        }
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!filterButton.contains(event.target) && !filterOptions.contains(event.target)) {
            filterOptions.classList.remove('show');
        }
    });
});
