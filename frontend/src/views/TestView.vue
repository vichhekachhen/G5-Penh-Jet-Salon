<template>
  <div>
    <v-card class="mx-auto" prepend-icon="$vuetify" subtitle="The #1 Vue UI Library" width="400">
      <template v-slot:title>
        <span class="font-weight-black">Welcome to Vuetify</span>
      </template>

      <v-card-text class="bg-surface-light pt-4">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, ratione debitis quis est
        labore voluptatibus! Eaque cupiditate minima, at placeat totam, magni doloremque veniam
        neque porro libero rerum unde voluptatem!
      </v-card-text>
    </v-card>
    <v-data-table :headers="headers" :items="posts" item-value="name"> </v-data-table>
  </div>
</template>

<script>
import { usePostStore } from '@/stores/post'
import { mapActions, mapState } from 'pinia'
export default {
  name: 'PostList',
  data() {
    return {
      headers: [
        {
          title: 'ID',
          align: 'start',
          sortable: false,
          key: 'id',
          with: '100px'
        },
        { title: 'Title', key: 'title' },
        { title: 'Description', key: 'description' },
        { title: 'user id (for show)', key: 'user_id' },
        { title: 'Publish', key: 'publish' }
      ]
    }
  },
  created() {
    this.getAllPosts()
  },
  computed: {
    ...mapState(usePostStore, ['posts'])
  },
  methods: {
    ...mapActions(usePostStore, ['getAllPosts'])
  }
}
</script>

<style>
</style>