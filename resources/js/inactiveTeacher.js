$(document).ready(function() {
    let currentPage = 1;
    let currentKeyword = '';

    function fetchData(page = 1, keyword = '') {
        $.ajax({
            url: '/admin/teacher/inactive/search',
            type: 'GET',
            data: {
                page: page,
                search: keyword,
            },
            success: function(response) {
                console.log(response);
                $('#list').html(response.list);
                $('#paginate').html(response.paginate);
                currentPage = page;
                currentKeyword = keyword;
            },
            error: function(error) {
                console.log(error);
            }
        })
    }

    $('#search').on('keyup', function() {
        var keyword = $(this).val();
        currentPage = 1;
        fetchData(currentPage, keyword);
    })
    $(document).on('click', '.paginate a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetchData(page, currentKeyword);
    })

    if (currentKeyword !== '') {
        fetchData();
    }
})