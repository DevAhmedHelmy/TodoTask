<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <ul class="list-group" v-sortable>
                            <li class="list-group-item">Foo</li>
                            <li class="list-group-item">Bar</li>
                            <li class="list-group-item">Baz</li>
                        </ul>
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
