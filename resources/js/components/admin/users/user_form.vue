<template>
    <div class="row">
        <div class="col-12">
            <div class="form-group col-4">
                <label for="">Name</label>
                <input type="email"
                       v-model="user.name"
                       class="form-control">
            </div>
            <div class="form-group col-4">
                <label for="">Email</label>
                <input type="email"
                       v-model="user.email"
                       class="form-control">
            </div>
            <div class="form-group col-4">
                <label for="">Password</label>
                <input type="password"
                       v-model="user.password"
                       class="form-control">
            </div>
            <div class="form-group col-4">
                <label for="">Date Of Birth</label>
                <datepicker v-model="user.birthday"
                            :monday-first="true"
                            :bootstrap-styling="true"
                            :language="ru">
                </datepicker>
            </div>
            <div class="form-group col-4">
                <button class="btn btn-outline-success" v-if="$route.params.id" @click="save">
                    Update
                </button>
                <button class="btn btn-outline-success" @click="save" v-else>
                    Create
                </button>
                <button class="btn btn-outline-secondary" @click="$router.push({ name: 'users' })">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>

<script>
  import Datepicker from 'vuejs-datepicker';
  import {ru,en} from 'vuejs-datepicker/dist/locale';

  export default {
    name: "user_form",
    components: {Datepicker},
    data() {
      return {
        user: {
          name: '',
          email: '',
          password: '',
          birthday: Date.now()
        },

        ru: ru,
        en: en
      }
    },
    methods: {
      async save() {
        if (this.$route.params.id) {
          const response = await axios.post('/users/update/' + this.$route.params.id, this.user);
          if (response.status !== 200 || response.data.status === 'error') {
            this.$swal('Error!', response.data.msg, 'error');
            return false;
          }
          this.$swal('Success!', response.data.msg, 'success');
          this.$router.push({ name: 'users' });
          return true;
        } else {
          const response = await axios.post('/users/create', this.user);
          if (response.status !== 200 || response.data.status === 'error') {
            this.$swal('Error!', response.data.msg, 'error');
            return false;
          }
          this.$swal('Success!', response.data.msg, 'success');
          this.$router.push({ name: 'users' });
          return true;
        }
      },

      async loadData() {
        const response = await axios.get('/users/edit/' + this.$route.params.id);
        if (response.status !== 200 || response.data.status === 'error') {
          this.$swal('Error!', response.data.msg, 'error');
          return false;
        }
        this.user = response.data.user;
        return true;
      }
    },
    created() {
      if (this.$route.params.id) {
        this.loadData();
      }
    }
  }
</script>

<style scoped>

</style>