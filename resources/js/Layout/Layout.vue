<template>
    <div>
        <header>
            <nav>
                <div>
                    <Link :href="route('home')" class="nav-link"
                        :class="{ 'bg-slate-700': $page.component === 'Home' }">
                    Home</Link>
                    <Link :href="route('posts')" class="nav-link" >Posts</Link>
                </div>

                <div v-if="$page.props.auth.user" class="space-x-6 flex">
                    <img class="avatar"
                        :src="$page.props.auth.user.avatar ?  $page.props.auth.user.avatar : '/storage/avatars/default.jpg'"
                        alt="">
                    <Link :href="route('dashboard')" method="get" class="nav-link"
                        :class="{ 'bg-slate-700': $page.component === 'Dashboard' }">Dashboard</Link>
                    <Link :href="route('logout')" method="post" as="button" class="nav-link">Logout</Link>
                </div>

                <div v-else class="space-x-6">
                    <Link :href="route('register')" class="nav-link"
                        :class="{ 'bg-slate-700': $page.component === 'Auth/Register' }">Register</Link>
                    <Link :href="route('login')" class="nav-link"
                        :class="{ 'bg-slate-700': $page.component === 'Auth/Login' }">Login</Link>
                </div>
            </nav>
        </header>
        <main class="p-4">
            <slot />
        </main>
    </div>
</template>