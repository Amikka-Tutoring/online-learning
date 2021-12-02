<template>
  <admin-layout>
    <div class="container">
      <div class="csv-buttons">
        <form class="my-4" enctype="multipart/form-data" action=""
              @submit.prevent="submit">
          <button type="submit" class="upload-csv">Upload CSV <span v-if="loading"
                                                                    class="spinner-border ml-2"
                                                                    style="width: 1.5rem; height: 1.5rem"></span><i
              style="color: #83d583"
              v-if="onsuccess" class="ml-2 bi bi-check-circle-fill" data-aos="zoom-in"
              data-aos-delay="300"></i><i
              v-if="onerror" class="ml-2 bi bi-x-circle-fill" data-aos="zoom-in" style="color: #dd6f6f"
              data-aos-delay="300"></i>
          </button>
          <div class="custom-file mt-2 custom-inputs">
            <input accept=".csv" id="csv" type="file" class="form-control-lg form-control p-0 h-auto"
                   required
                   @input="form.file=$event.target.files[0]">
          </div>
        </form>
      </div>
      <div v-if="questions_added" class="card row flex-row p-4 mb-5"
           style="background: rgba(240, 244, 243, 1)"
           data-aos="fade-up" data-aos-delay="300">
        <div class="col-md-12">
          <h5 class="mb-2" v-if="questions_added">Questions added: <span
              class="badge badge-primary">{{ questions_added.length }}</span>
          </h5>
          <div class="body" v-for="question in questions_added">
            <p><i
                style="color: #83d583"
                class="mr-2 bi bi-check-circle-fill" data-aos="zoom-in"
                data-aos-delay="100"></i> {{ question }}</p>
          </div>
        </div>
      </div>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

export default {
  components: {
    AdminLayout,
  },
  props: ['user'],
  methods: {
    submit() {
      let formData = new FormData();
      formData.append("file", this.form.file);
      this.loading = true
      this.onsuccess = false
      this.onerror = false
      axios.post(route('perfect-tutor-match-store'), formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
          .then(response => {
                if (response.data.message) {
                  this.toast.success(response.data.message);
                  this.onsuccess = true
                  this.questions_added = response.data.questions
                }
                if (response.data.error) {
                  this.toast.error(response.data.error)
                  this.onerror = true
                }
              }
          )
          .catch(error => {
            this.onerror = true
            Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
          }).finally(() => {
        this.loading = false
      });
    },
  },

  data() {
    return {
      form: {
        file: null
      },
      loading: false,
      onsuccess: false,
      onerror: false,
      questions_added: null
    }
  },
}
</script>
