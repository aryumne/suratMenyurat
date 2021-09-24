
const checkbox2 = document.getElementById('checkbox2');
const checkbox3 = document.getElementById('checkbox3');

    checkbox2.addEventListener('change', (event) => {
    var id = document.getElementById("checkId").value;
    let _url = `/admin/updateWithAjax/${id}`;
    let check = $("input[name=checkbox2]").val();
    let unCheck = 1;
    if (event.currentTarget.checked) {
            $.ajax({
                url: _url,
                type: "GET",
                data: {
                    "edit_status": check,
                },
                success: function (response) {
                    console.log(response);
                },
            });
        location.reload();
        } else {
              $.ajax({
                url: _url,
                type: "GET",
                data: {
                    "edit_status": unCheck,
                },
                success: function (response) {
                    console.log(response);
                },
              });
        location.reload();
        }
    });
    checkbox3.addEventListener('change', (event) => {
    var id = document.getElementById("checkId").value;
    let _url = `/admin/updateWithAjax/${id}`;
    let check = $("input[name=checkbox3]").val();
    let unCheck = 2;
    if (event.currentTarget.checked) {
            $.ajax({
                url: _url,
                type: "GET",
                data: {
                    "edit_status": check,
                },
                success: function (response) {
                    console.log(response);
                },
            });
        location.reload();
        } else {
             $.ajax({
                url: _url,
                type: "GET",
                data: {
                    "edit_status": unCheck,
                },
                success: function (response) {
                    console.log(response);
                },
             });
        location.reload();
        }

    });


    // add more row for file upload
    var x = 0;
    function addRow() {
        x++;
        var html =
            '<div class="input-group mb-3" id="row' + x +
            '"><input type="file" class="form-control" id="path_lampiran" name="path_lampiran[]"><button class="btn btn-outline-danger" type="button" onclick="removeRow(' +
            x + ')">Hapus</button></div>';
        $('#rows').append(html);
    }
    //remove row
    function removeRow(y) {
        var row = '#row' + y;
        $(row).remove();
    }
