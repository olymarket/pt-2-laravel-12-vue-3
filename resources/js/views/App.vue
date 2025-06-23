<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img width="40"
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/2367px-Vue.js_Logo_2.svg.png">
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link exact-active-class="active" :to="{ name:'admin.agenda.index'}" class="nav-link">Agenda</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </main>
</template>