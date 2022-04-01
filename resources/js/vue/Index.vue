<template>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="navbar-brand">
                <h1> Etermed</h1>
            </div>

            <div class="collapse navbar-collapse">
                <div class="navbar-nav mr-auto">
                    <router-link class="nav-link" :to="{ name: 'patients' }">Baza pacjentów</router-link>
                    <router-link class="nav-link" :to="{ name: 'diseases' }">Baza chorób</router-link>

                </div>
            </div>
        </nav>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>

    </div>
</template>
