<template>
<div class="col-md-12">
  <a data-toggle="modal" data-target="#exampleModal" class="btnMenu" href="#">
    <img src="{{ asset('images/booktable.jpg') }}" class="img-fluid mx-auto d-block"/>
  </a>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="col-md-12">
                      <a data-toggle="modal" data-target="#exampleModal" class="btnMenu" href="#">
                        <img src="{{ asset('images/booktable.jpg') }}" class="img-fluid mx-auto d-block"/>
                      </a>
                    </div>
                    <div class="card-body">
                        I'm an example component.asdasdasd
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
