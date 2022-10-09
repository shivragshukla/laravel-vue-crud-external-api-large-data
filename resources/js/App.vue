<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="collapse navbar-collapse">
            <div class="navbar-nav" >
                <router-link to="/" class="nav-item nav-link" >Home </router-link>
            </div>
        </div>
    </nav>
    <div class="container">
        <router-view> </router-view>
    </div>
</template>