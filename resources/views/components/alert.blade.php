@if (session()->has('sucess'))
    <script>
        document.addEventListener('DOMContentLoaded', ()=> {
            Swal.fire(
            'Sucesso', "{{ session('sucess') }}", 'success'
            );
        })
    </script>
@endif

@if ($errors->any())
    @php 
        $messagem = '';
        foreach ($errors->all() as $error){
            $messagem .= $error . '<br>';
        }        
    @endphp
    
    <script>
        document.addEventListener('DOMContentLoaded', ()=> {
            Swal.fire(
            'Erro!', "{!! $messagem !!}", 'error'
            );
        })
    </script>
@endif