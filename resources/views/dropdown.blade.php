<!DOCTYPE html>
<html>
<head>
    <title>Dependent dropdown example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="m-5 w-50">
        <h1 class="lead">Dependent dropdown example</h1>
        <div class="mb-3">
            <select class="form-select form-select-lg mb-3" id="state">
                <option selected disabled>Select state</option>
                @foreach ($states as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <select class="form-select form-select-lg mb-3" id="city"></select>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#state').on('change', function () {
                var stateId = this.value;
                $('#city').html('');
                $.ajax({
                    url: '{{ route('getCities') }}?state_id='+stateId,
                    type: 'get',
                    success: function (res) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(res, function (key, value) {
                            $('#city').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>