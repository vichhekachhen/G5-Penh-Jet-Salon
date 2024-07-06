<template>
    <v-app>
        <v-container fluid>
            <v-row>
                <!-- Sidebar menu column -->
                <v-col cols="2">
                    <!-- Sidebar menu content -->
                </v-col>
                <!-- Main content column -->
                <v-col cols="10">
                    <v-container fluid class="pa-4 mt-35">
                        <v-row>
                            <v-col cols="12" sm="6" md="4" lg="3" v-for="(item, index) in items" :key="index">
                                <v-card class="business-support-card d-flex flex-row">
                                    <v-img :src="item.image" alt="Card Image" class="card-image" width="40%"></v-img>
                                    <v-card-text class="card-text">
                                        <h5>{{ item.title }}</h5>
                                        <p>{{ item.description }}</p>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
    <NavBar></NavBar>
</template>

<script>
import NavBar from "../ShopOwner/Navbar.vue";

export default {
    components: { NavBar },
    name: "Dashboard",
    data() {
        return {
            items: [
                { title: 'Amount', description: '$100/day', image: 'https://img.freepik.com/free-vector/gold-coin-money-floating-cartoon-vector-icon-illustration-business-finance-isolated-flat-vector_138676-11049.jpg?size=338&ext=jpg&ga=GA1.1.1141335507.1719100800&semt=ais_user' },
                { title: 'Amount', description: '$1000/week', image: 'https://img.freepik.com/free-vector/gold-coin-money-floating-cartoon-vector-icon-illustration-business-finance-isolated-flat-vector_138676-11049.jpg?size=338&ext=jpg&ga=GA1.1.1141335507.1719100800&semt=ais_user' },
                { title: 'Customer', description: '10N/day', image: 'https://img.freepik.com/free-vector/gold-coin-money-floating-cartoon-vector-icon-illustration-business-finance-isolated-flat-vector_138676-11049.jpg?size=338&ext=jpg&ga=GA1.1.1141335507.1719100800&semt=ais_user' },
                { title: 'Total Customer', description: '200/week', image: 'https://img.freepik.com/free-vector/gold-coin-money-floating-cartoon-vector-icon-illustration-business-finance-isolated-flat-vector_138676-11049.jpg?size=338&ext=jpg&ga=GA1.1.1141335507.1719100800&semt=ais_user' },
            ],
        };
    },
};
</script>

<style scoped>
.business-support-card {
    background-color: #001f54;
    color: #fff;
    border-radius: 20px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    transition: transform 0.2s;
}

.business-support-card:hover {
    transform: translateY(-10px);
    cursor: pointer;
}

.card-image {
    object-fit: cover;
}

.card-text {
    padding: 16px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.headline {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
}

@media (max-width: 767px) {
    .business-support-card {
        margin-bottom: 18px;
    }

    .headline {
        font-size: 1.125rem;
    }
}
</style>
