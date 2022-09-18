<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>
 .pointer {
     cursor:pointer;
  }
</style>
</head>
<body>
    <div class="container">
        <h1>Laravel Change Status Using Toggle Button Example</h1>
        <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
               </tr> 
            </thead>
            <tbody>
               @foreach($users as $user)
                  <tr>
                     <td>{{ $user->name }}</td>
                     <td>{{ $user->email }}</td>
                     <td>
                       <div class="form-group">
                         <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input"
                            {{($user->status) ? 'checked' : ''}}
                              onclick="changeUserStatus(event.target, {{ $user->id }});">
                           <label class="custom-control-label pointer"></label>
                        </div>
                     </div>
                     </td>
                  </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
function changeUserStatus(_this, id) {
    var status = $(_this).prop('checked') == true ? 1 : 0;
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: `/change-status`,
        type: 'post',
        data: {
            _token: _token,
            id: id,
            status: status 
        },
        success: function (result) {
        }
    });
}

</script>
</html>