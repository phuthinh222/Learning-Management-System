import { routes } from './url/route.js';

document.addEventListener('DOMContentLoaded', () => {
    let currentPage = 1;
    let currentKeyword = '';

    const fetchData = (page = 1, keyword = '') => {
        fetch(routes.teacher.searchInactive, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
            query: new URLSearchParams({
                page: page,
                search: keyword
            }).toString()
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.querySelector('#list').innerHTML = data.list;
            document.querySelector('#paginate').innerHTML = data.paginate;
            currentPage = page;
            currentKeyword = keyword;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };

    document.querySelector('#search').addEventListener('keyup', () => {
        const keyword = document.querySelector('#search').value;
        currentPage = 1;
        fetchData(currentPage, keyword);
    });

    document.addEventListener('click', (e) => {
        if (e.target.matches('.paginate a')) {
            e.preventDefault();
            const page = new URL(e.target.href).searchParams.get('page');
            fetchData(page, currentKeyword);
        }
    });

    if (currentKeyword !== '') {
        fetchData();
    }
});
