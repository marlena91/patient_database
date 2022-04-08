<template>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link class="nav-link" :to="{ name: 'patients' }">
                <div class="navbar-brand">
                    <h1> Etermed</h1>
                </div>
            </router-link>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'patients' }">Baza pacjentów</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'diseases' }">Baza chorób</router-link>
                        </li>
                        <li class="nav-item ">
                        <router-link class="nav-link" :to="{ name: 'login' }">Logowanie</router-link>
                         </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>

    </div>
</template>
