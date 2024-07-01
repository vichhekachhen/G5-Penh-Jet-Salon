<template>
  <v-app>
    <!-- Navbar -->
    <v-app-bar app color="white" elevate-on-scroll>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-avatar size="40" style="border-radius: 8px; overflow: hidden;">
        <v-img src="https://buffer.com/library/content/images/size/w1200/2023/10/free-images.jpg" contain></v-img>
      </v-avatar>

      <v-toolbar-title class="text-primary"><b>PENH JET SALON</b></v-toolbar-title>
      <v-spacer></v-spacer>

      <!-- Search Input -->
      <v-text-field v-show="!isMobile" append-icon="mdi-magnify" label="Search" single-line hide-details
        class="mx-4"></v-text-field>

      <!-- Notification Bell -->
      <v-menu bottom right>
        <template v-slot:activator="{ on, attrs }">
          <v-btn v-bind="attrs" v-on="on" icon>
            <v-badge content="9" color="red" overlap>
              <v-icon>mdi-bell</v-icon>
            </v-badge>
          </v-btn>
        </template>
        <v-list>
          <v-list-item v-for="(item, index) in notifications" :key="index">
            <v-list-item-avatar>
              <v-img :src="item.avatar"></v-img>
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>{{ item.name }}</v-list-item-title>
              <v-list-item-subtitle>{{ item.message }}</v-list-item-subtitle>
              <v-list-item-subtitle>{{ item.time }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <!-- Additional items go here -->
        </v-list>
      </v-menu>
    </v-app-bar>

    <!-- Sidebar -->
    <v-navigation-drawer v-model="drawer" :rail="rail" permanent @click="rail = false">


      <v-list nav>
        <v-list-item align="center">
          <v-list-item-avatar>
            <v-avatar size="60" style="border-radius: 8px; overflow: hidden;">
              <v-img src="https://randomuser.me/api/portraits/men/85.jpg" contain></v-img>
            </v-avatar>
          </v-list-item-avatar>

          <v-list-item-content class="text-center">
            <v-list-item-subtitle style="font-size: 18px;">Salon Owner</v-list-item-subtitle>
            <v-list-item-title class="text-body-1 mr-2" style="font-size: 16px;">John Leider</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>


      <v-divider></v-divider>

      <v-list density="compact" nav>
        <v-list-item prepend-icon="mdi-account-group-outline" title="Dashboard" value="Dashboard"
          :to="{ path: '/Dashboard' }"></v-list-item>
        <v-list-item prepend-icon="mdi-account-group-outline" title="Calendar" value="Calendar"
          :to="{ path: '/Calendar' }"></v-list-item>
        <v-list-item prepend-icon="mdi-account-group-outline" title="Messages" value="Messages"
          :to="{ path: '/messages' }"></v-list-item>
        <v-list-item prepend-icon="mdi-account-group-outline" title="Add Products & Service"
          value="Add Products & Service"></v-list-item>
        <v-list-item prepend-icon="mdi-account-group-outline" title="Orders" value="Orders"></v-list-item>
        <v-list-item prepend-icon="mdi-account-group-outline" title="Customers" value="Customers"></v-list-item>
        <v-list-item prepend-icon="mdi-account-group-outline" title="Settings" value="Settings"></v-list-item>
      </v-list>
    </v-navigation-drawer>

    <!-- Main Content -->
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      drawer: true,
      miniVariant: true,
      isMobile: false,
      notifications: [
        { name: 'Veak Khlop', message: 'Check out this interesting article!', time: '1 year ago', avatar: 'https://t4.ftcdn.net/jpg/06/08/55/73/360_F_608557356_ELcD2pwQO9pduTRL30umabzgJoQn5fnd.jpg' },
        { name: 'Makara Try', message: 'Check out this interesting article!', time: '1 day ago', avatar: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAcZUYZ7y_E5rfCrLNUNDOJEf-0Ii6wgRlyRB1ywNheQdzqjg_muOu9YwnAuq9ZEn50tc&usqp=CAU' }
      ]
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
      this.isMobile = window.innerWidth <= 600;
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
