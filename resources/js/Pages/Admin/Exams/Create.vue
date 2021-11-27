<template>
  <admin-layout>
    <div class="container" data-aos="fade-up">
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
            <th>Practice Exam Title</th>
            <th>URL</th>
            <th>Subject</th>
            <th>Created</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(exam,index) in exams" v-if="exams.length">
            <td><input type="text" v-model="exam.title" class="border-0"></td>
            <td><input type="url" v-model="exam.url" class="border-0"></td>
            <td><input type="text" v-model="exam.subject" class="border-0"></td>
            <td class="text-center">{{ moment(exam.created_at).format("DD-MM-YYYY") }}</td>
            <td class="text-center">
              <div class="btn btn-primary pt-0 pb-0 mr-2 action-buttons"
                   style="background-color: #4C6ED7;" @click="update(exam)">Edit
              </div>
              <div class="btn btn-danger pt-0 pb-0 action-buttons" @click="deleteExam(exam,index)">
                Delete
              </div>
            </td>
          </tr>
          <p v-else>No row found</p>
          </tbody>
        </table>
      </div>
    </div>

  </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import moment from 'moment'

export default {
  components: {
    AdminLayout,
  },
  props: ['user', 'exams'],
  methods: {
    update: function (data) {
      axios.put(route('exams.update', data.id), data)
          .then(response => {
            this.toast.info(response.data.message);
          })
          .catch(error => {
            Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
          });
    },
    deleteExam: function (data, index) {
      if (!confirm('Are you sure want to remove?')) return;
      this.exams.splice(index, 1)
      axios.delete(route('exams.delete', data.id))
          .then(response => {
            this.toast.info(response.data.message);
          })
          .catch(error => {
                Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
              }
          );
    },
    submit() {
      let formData = new FormData();
      formData.append("file", this.form.file);
      this.loading = true
      this.onsuccess = false
      this.onerror = false
      axios.post(route('exams.store'), formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
          .then(response => {
                console.log(response.data)
                if (response.data.message) {
                  this.toast.info(response.data.message);
                  this.onsuccess = true
                  this.getExams();
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
    getExams: function () {
      axios.get(route('exams.api')).then(response => {
        this.exams = response.data
      })
    }
  },

  data() {
    return {
      exams: this.exams,
      moment: moment,
      form: {
        file: null
      },
      loading: false,
      onsuccess: false,
      onerror: false,
    }
  },
  mounted() {
  }
}
</script>
