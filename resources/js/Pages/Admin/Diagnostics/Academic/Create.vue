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
      <div class="csv-table">
        <table>
          <thead>
          <tr>
            <th>subject_name</th>
            <th>relevant_images</th>
            <th>question_number</th>
            <th>question</th>
            <th>option_a</th>
            <th>option_b</th>
            <th>option_c</th>
            <th>option_d</th>
            <th>option_e</th>
            <th>option_f</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="n in 10">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          </tbody>
        </table>
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
      axios.post(route('admin.courses.store'), formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
          .then(response => {
                if (response.data.message) {
                  this.toast.info(response.data.message);
                  this.onsuccess = true
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
    }
  },
}
</script>
