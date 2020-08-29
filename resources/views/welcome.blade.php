@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome') }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese un nombre" onkeyup="debounceSearchName()">
                        </div>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody id="users">
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        /******************
         * Get all users
         *******************/
        const usersElement = document.getElementById('users');

        let users = [];
        window.axios.get('/api/users')
        .then(response => {
            users = response.data


            users.map( u => {

                let tr = document.createElement('tr')
                let td1 = document.createElement('td')
                let td2 = document.createElement('td')
                let td3 = document.createElement('td')

                td1.innerText = u.id
                td2.innerText = u.name
                td3.innerText = u.email

                tr.appendChild(td1)
                tr.appendChild(td2)
                tr.appendChild(td3)

                usersElement.appendChild(tr);

            });
        }).catch(error => {
            alert(error)
        })

    </script>



    <script>
        const debounceSearchName = window._.debounce(searchName)
        function searchName() {
            let inputName = document.getElementById('name');
            let search = inputName.value.trim();
            if (search.length > 0){


                const usersElement = document.getElementById('users');
                usersElement.innerText=''

                let users = [];
                window.axios.get('/api/users?search='+search)
                    .then(response => {
                        users = response.data


                        users.map( u => {

                            let tr = document.createElement('tr')
                            let td1 = document.createElement('td')
                            let td2 = document.createElement('td')
                            let td3 = document.createElement('td')

                            td1.innerText = u.id
                            td2.innerText = u.name
                            td3.innerText = u.email

                            tr.appendChild(td1)
                            tr.appendChild(td2)
                            tr.appendChild(td3)

                            usersElement.appendChild(tr);

                        });
                    }).catch(error => {
                    alert(error)
                })



            }
        }

    </script>
@endpush


