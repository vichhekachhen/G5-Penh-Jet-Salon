<template>
    <v-app>
        <!-- Navbar -->
        <v-app-bar app color="#001f54" elevate-on-scroll>
            <!-- Drawer toggle button -->
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <!-- Spacer to push elements to the right -->
            <v-spacer></v-spacer>

            <!-- User Information -->
            <v-row align="center" justify="end" class="mr-2">
                <v-col class="text-right">
                    <v-toolbar-title class="text-white mb-1">John Wick</v-toolbar-title>
                    <v-list-item-subtitle class="mb-3" style="font-size: 14px;">Salon Owner</v-list-item-subtitle>
                </v-col>
                <v-avatar size="50" style="border-radius: 8px;" class="mr-2">
                    <v-img src="https://buffer.com/library/content/images/size/w1200/2023/10/free-images.jpg"
                        contain></v-img>
                </v-avatar>
            </v-row>
        </v-app-bar>
        <!-- Sidebar -->
        <v-navigation-drawer v-model="drawer" :rail="rail" app dark color="#001f54" permanent @click="rail = false">
            <v-list density="compact" nav>
                <v-list-item prepend-icon="mdi-view-dashboard" title="Dashboard" value="Dashboard"
                    :to="{ path: '/dashboard' }"></v-list-item>
                <v-list-item prepend-icon="mdi-shape-plus" title="Category" value="Category"
                    :to="{ path: '/categories' }"></v-list-item>
                <v-list-item prepend-icon="mdi-cart" title="Service" value="Service"
                    :to="{ path: '/services' }"></v-list-item>   
                <v-list-item prepend-icon="mdi-domain" title="Appointment" value="Appointment"
                    :to="{ path: '/appointments' }"></v-list-item>
                <v-list-item prepend-icon="mdi-face-agent" title="Report" value="Report"
                    :to="{ path: '/report' }"></v-list-item>
                <v-divider :thickness="2" class="border-opacity-25"></v-divider>
                <v-list-item prepend-icon="mdi-logout" title="Log Out" value="Logout"
                    :to="{ path: '/Logout' }"></v-list-item>
            </v-list>
        </v-navigation-drawer>
        <!-- Main Content -->
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
// show sidebar 
export default {
    data() {
        return {
            drawer: true,
            miniVariant: true,
            isMobile: false,
        };
    },
    created() {
        this.checkIfMobile();
        window.addEventListener("resize", this.checkIfMobile);
    },
    destroyed() {
        window.removeEventListener("resize", this.checkIfMobile);
    },
    methods: {
        checkIfMobile() {
            this.isMobile = window.innerWidth <= 800;
        },
        toggleMiniVariant() {
            this.miniVariant = !this.miniVariant;
        }
    }
};

</script>

<style scoped>
.v-application {
    background-color: #f5f5f5;
}
</style>