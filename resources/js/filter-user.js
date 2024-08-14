document.addEventListener('DOMContentLoaded', () => {
    const filterButton = document.getElementById('filter-button');
    const filterOptions = document.getElementById('filter-options');
    const typeSelect = document.getElementById('type-select');
    const detailSelect = document.getElementById('detail-select');

    const options = {
        student: [{
                value: 'khoa1',
                text: 'Khóa 1'
            },
            {
                value: 'khoa2',
                text: 'Khóa 2'
            },
            {
                value: 'khoa3',
                text: 'Khóa 3'
            }
        ],
        teacher: [{
                value: 'lop1',
                text: 'Lớp 1'
            },
            {
                value: 'lop2',
                text: 'Lớp 2'
            },
            {
                value: 'lop3',
                text: 'Lớp 3'
            }
        ],
        accountant: [{
                value: 'dang-lam-viec',
                text: 'Đang làm việc'
            },
            {
                value: 'da-nghi',
                text: 'Đã nghỉ'
            }
        ]
    };

    filterButton.addEventListener('click', () => {
        filterOptions.classList.toggle('show');
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