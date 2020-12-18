<!DOCTYPE html>
<html>

<head>
    <title>Live Data Search with Pagination in PHP using Ajax</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
</head>

<body>
    <br />
    <div class="container">
        <h3 align="center">Live Data Search with Pagination in PHP Mysql using Ajax</h3>
        <br />
        <div class="card">
            <div class="card-header">Dynamic Data</div>
            <div class="card-body">
                <div class="filter-section">
                    <div class="form-group d-lg-flex ">
                        <input type="text" name="search_box" id="search_box" class="form-control w-25" placeholder="Type your search query here" />
                        <select class="form-control form-control-sm w-25" id="filter">
                            <option class="select_option" selected="selected   " value="">--Filter--</option>
                            <option class="select_option" value='name'>Name</option>
                            <option class="select_option" value='email'>email</option>
                        </select>
                    </div>

                </div>
                <div class="table-responsive" id="dynamic_content">

                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        function load_data(page, query = '', filter) {
            $.ajax({
                url: 'fetch.php',
                method: 'POST',
                data: {
                    page: page,
                    query: query,
                    filter: filter ? filter : undefined
                },
                success: function(data) {
                    console.log(data)
                    $('#dynamic_content').html(data);
                }
            })
        }
        let valueFilter = '0';

        load_data(1,'',valueFilter);
        $('#search_box').keyup(function(e) {
            var query = e.currentTarget.value;            
            load_data(1,query, valueFilter);
        })
        $(document).on('click', '.page-link', function(e) {
            let page = e.currentTarget.getAttribute('data-page_number');
            let query = $('#search_box').val();
            load_data(page, query, valueFilter);
        })

        $("#filter").on('change', function() {
            let value = $(this).val();
            let query = $("#search_box").val();
            console.log(valueFilter + ' : '+query);
            load_data(1, query, value ? value : valueFilter);
        })
    });
</script>