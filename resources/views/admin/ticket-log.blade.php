<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <!--hiii-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employee</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/JavaScript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js"></script>
    <style>
        body {
            font-size: 16px !important;
        }

        th {
            text-align: right;
        }

        .material-icons {
            font-family: 'Material Icons';
            font-weight: bold !important;
            font-style: unset !important;
            font-size: unset !important;
            line-height: unset !important;
            letter-spacing: unset !important;
            text-transform: unset !important;
            display: unset !important;
            white-space: unset !important;
            word-wrap: unset !important;
            direction: unset !important;
            -webkit-font-feature-settings: unset !important;
            -webkit-font-smoothing: unset !important;
        }

        .container {
            margin-bottom: 75px;
        }

        * {
            font-family: 'Cairo', sans-serif;
        }

        .material-icons:hover {
            cursor: pointer;
        }


        #date {
            width: 87px;
            padding: 3px;
        }

        .smallInput {
            width: 105px;
            padding: 5px;
        }

        textarea {
            min-width: 100px;
            min-height: 34px;
            max-width: 250px;
            max-height: 100px;
        }

        .modal-body {
            font-size: 16px;
            text-align: center;
            overflow-wrap: anywhere;
        }

        .modal-title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        td, th {
            text-align: center;
        }

        .notes:hover, .replys:hover {
            cursor: pointer;
            background-color: rgba(153, 153, 153, 0.4);
        }

        .openButton {
            border: 1px solid grey;
            padding: 5px 10px;
            border-radius: 50px;
            background-color: lightgrey;
        }
    </style>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

<div class="container">
    <form method="get" action="{{url('insert')}} " enctype="multipart/form-data" id="form1"></form>
    <table id="logTable" class="table table-bordered table-striped table-hover">

        <thead>
        <tr style=" background-color: lightgoldenrodyellow;">
            <th>التاريخ<i class="material-icons" onclick="sortTable(0)">arrow_drop_down</i></th>
            <th>تعديل بواسطة<i class="material-icons" onclick="sortTable(1)">arrow_drop_down</i></th>
            <th>الوصف<i class="material-icons" onclick="sortTable(2)">arrow_drop_down</i></th>
            <th>اسم/ايميل الطالب<i class="material-icons">arrow_drop_down</i></th>
            <th>رقم الهاتف</th>
            <th>المشكلة</th>
            <th>الشخص المعني<i class="material-icons" onclick="sortTable(6)">arrow_drop_down</i></th>
            <th>ملاحظات</th>
            <th>الحالة<i class="material-icons" onclick="sortTable(8)">arrow_drop_down</i></th>
            <th>الردود</th>

        </tr>
        </thead>
        <tbody id="tbody">

        @foreach($data as $key=>$record)
            <tr id="{{$record->id}}">
                <td>{{$record->created_at}}</td>
                <td>{{$record->modified_by}}</td>
                <td>{{$record->description}}</td>
                <td>{{$record->ticket_data[0]['student_name']}}</td>
                <td>{{$record->ticket_data[0]['phone_no']}}</td>
                <td>{{$record->ticket_data[0]['issue']}}</td>
                <td>{{$record->ticket_data[0]['resp_emp']}}</td>
                <td>{{$record->ticket_data[0]['notes']}}</td>
                <td>{{$record->ticket_data[0]['status']}}</td>
                <td><button class="btn btn-default" data-toggle="modal" data-target="#replyModal"><i class="material-icons">reply</i></button></td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="replyModal"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modalIcon" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true" class="closed">&times;</span>
                </button>
                <h3 class="modal-title">الردود</h3>
            </div>
            <div class="modal-body">

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 160px">التاريخ</th>
                        <th style="width: 160px">اسم الموظف</th>
                        <th style="width: 360px">الرد</th>
                    </tr>
                    </thead>
                    <tbody id="replyBody">
                    @foreach($replies as $reply)
                        <tr>
                            <td>{{$reply->created_at}}</td>
                            <td>{{$reply->emp_name}}</td>
                            <td>{{$reply->reply}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">موافق</button>
            </div>
        </div>
    </div>
</div>



<script>
    {{--function getReplies(ticket_id) {--}}

    {{--    $("#replyBody").empty();--}}
    {{--    $.ajax({--}}
    {{--        url: '{{route('getreplies')}}',--}}
    {{--        data: {'tik_id': ticket_id},--}}
    {{--        type: 'get',--}}
    {{--        success: function (data) {--}}
    {{--            for (i = 0; i < data.length; i++) {--}}
    {{--                $("#replyBody").append('<tr><td>' + data[i].created_at + '</td><td>' + data[i].emp_name + '</td><td>' + data[i].reply + '</td>');--}}
    {{--            }--}}


    {{--            $("#replyModal").modal("show");--}}
    {{--            // $("getTicketId").setAttribute('value',ticket_id);--}}
    {{--            document.getElementById('getTicketId').setAttribute('value', ticket_id);--}}
    {{--        }--}}

    {{--    })--}}

    {{--}--}}

    $( document ).ready(function() {
        sortTable(0);
    });
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("logTable");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc";
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /*check if the two rows should switch place,
                based on the direction, asc or desc:*/
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                //Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {
                /*If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again.*/
                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }


</script>
</body>
</html>


