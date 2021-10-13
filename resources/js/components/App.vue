<template>
    <div>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link to="/" class="nav-item nav-link">Home</router-link>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="mx-auto">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {}
</script>
