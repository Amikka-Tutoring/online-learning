<template>
  <admin-layout>
    <div class="container">
      <div v-if="$page.props.flash.message" class="alert alert-success">
        {{ $page.props.flash.message }}
      </div>
      <div class="csv-buttons">
        <form
            class="my-4"
            enctype="multipart/form-data"
            action=""
            @submit.prevent="submit"
        >
          <button type="submit" class="upload-csv" :disabled="disable">
            Upload CSV
            <span
                v-if="loading"
                class="spinner-border ml-2"
                style="width: 1.5rem; height: 1.5rem"
            ></span
            ><i
              style="color: #83d583"
              v-if="onsuccess"
              class="ml-2 bi bi-check-circle-fill"
              data-aos="zoom-in"
              data-aos-delay="300"
          ></i
          ><i
              v-if="onerror"
              class="ml-2 bi bi-x-circle-fill"
              data-aos="zoom-in"
              style="color: #dd6f6f"
              data-aos-delay="300"
          ></i>
          </button>
          <div class="custom-file mt-2 custom-inputs">
            <input
                accept=".csv"
                id="csv"
                type="file"
                class="form-control-lg form-control p-0 h-auto"
                required
                @input="form.file = $event.target.files[0]"
            />
          </div>
        </form>
      </div>
      <div
          v-if="courses || top_layers || mid_layers || less_layers"
          class="card row flex-row p-4"
          style="background: rgba(240, 244, 243, 1)"
          data-aos="fade-up"
          data-aos-delay="300"
      >
        <div class="col-md-6">
          <h5 class="mb-2" v-if="courses">
            Courses created:
            <span class="badge badge-primary">{{ courses.length }}</span>
          </h5>
          <div class="body" v-for="course in courses">
            <p>
              <i
                  style="color: #83d583"
                  class="mr-2 bi bi-check-circle-fill"
                  data-aos="zoom-in"
                  data-aos-delay="100"
              ></i>
              {{ course }}
            </p>
          </div>
          <p v-if="courses.length == 0">
            <i
                style="color: #4c6ed7"
                class="mr-2 bi bi bi-info-circle-fill"
                data-aos="zoom-in"
                data-aos-delay="100"
            ></i>
            No course inserted
          </p>
        </div>
        <div class="col-md-6">
          <h5 class="mb-2" v-if="top_layers">
            Top Layers created:
            <span class="badge badge-primary">{{ mid_layers.length }}</span>
          </h5>
          <div class="body" v-for="toplayer in top_layers">
            <p>
              <i
                  style="color: #83d583"
                  class="mr-2 bi bi-check-circle-fill"
                  data-aos="zoom-in"
                  data-aos-delay="100"
              ></i>
              {{ toplayer }}
            </p>
          </div>
          <p v-if="top_layers.length == 0">
            <i
                style="color: #4c6ed7"
                class="mr-2 bi bi bi-info-circle-fill"
                data-aos="zoom-in"
                data-aos-delay="100"
            ></i>
            No top layer inserted
          </p>
        </div>
        <div class="col-md-6">
          <h5 class="mb-2" v-if="mid_layers">
            Mid Layers created:
            <span class="badge badge-primary">{{ mid_layers.length }}</span>
          </h5>
          <div class="body" v-for="midlayer in mid_layers">
            <p>
              <i
                  style="color: #83d583"
                  class="mr-2 bi bi-check-circle-fill"
                  data-aos="zoom-in"
                  data-aos-delay="100"
              ></i>
              {{ midlayer }}
            </p>
          </div>
          <p v-if="mid_layers.length == 0">
            <i
                style="color: #4c6ed7"
                class="mr-2 bi bi bi-info-circle-fill"
                data-aos="zoom-in"
                data-aos-delay="100"
            ></i>
            No mid layer inserted
          </p>
        </div>
        <div class="col-md-6">
          <h5 class="mb-2" v-if="less_layers">
            Lessons created:
            <span class="badge badge-primary">{{ less_layers.length }}</span>
          </h5>
          <div class="body" v-for="lesson in less_layers">
            <p>
              <i
                  style="color: #83d583"
                  class="mr-2 bi bi-check-circle-fill"
                  data-aos="zoom-in"
                  data-aos-delay="100"
              ></i>
              {{ lesson }}
            </p>
          </div>
          <p v-if="less_layers.length == 0">
            <i
                style="color: #4c6ed7"
                class="mr-2 bi bi bi-info-circle-fill"
                data-aos="zoom-in"
                data-aos-delay="100"
            ></i>
            No lesson inserted
          </p>
        </div>
        <div class="col-md-6">
          <h5 class="mb-2" v-if="videos">
            Videos created:
            <span class="badge badge-primary">{{ videos.length }}</span>
          </h5>
          <div class="body" v-for="video in videos">
            <p>
              <i
                  style="color: #83d583"
                  class="mr-2 bi bi-check-circle-fill"
                  data-aos="zoom-in"
                  data-aos-delay="100"
              ></i>
              {{ video }}
            </p>
          </div>
          <p v-if="videos.length == 0">
            <i
                style="color: #4c6ed7"
                class="mr-2 bi bi bi-info-circle-fill"
                data-aos="zoom-in"
                data-aos-delay="100"
            ></i>
            No video inserted
          </p>
        </div>
        <div class="col-md-6">
          <h5 class="mb-2" v-if="questions">
            Questions created:
            <span class="badge badge-primary">{{ questions.length }}</span>
          </h5>
          <div class="body" v-for="question in questions">
            <p>
              <i
                  style="color: #83d583"
                  class="mr-2 bi bi-check-circle-fill"
                  data-aos="zoom-in"
                  data-aos-delay="100"
              ></i>
              {{ question }}
            </p>
          </div>
          <p v-if="questions.length == 0">
            <i
                style="color: #4c6ed7"
                class="mr-2 bi bi bi-info-circle-fill"
                data-aos="zoom-in"
                data-aos-delay="100"
            ></i>
            No question inserted
          </p>
        </div>
      </div>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import {Inertia} from "@inertiajs/inertia";

export default {
  props: {
    user: Object,
    errors: Object,
  },
  components: {
    AdminLayout,
  },
  data() {
    return {
      form: {
        file: null,
      },
      loading: false,
      onsuccess: false,
      onerror: false,
      courses: null,
      top_layers: null,
      mid_layers: null,
      less_layers: null,
      disable: false,
    };
  },
  methods: {
    submit() {
      let formData = new FormData();
      formData.append("file", this.form.file);
      this.loading = true;
      this.onsuccess = false;
      this.onerror = false;
      this.disable = true

      axios
          .post(route("admin.courses.store"), formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((response) => {
            if (response.data.message) {
              this.toast.info(response.data.message);
              this.onsuccess = true;
            }
            if (response.data.error) {
              this.toast.error(response.data.error);
              this.onerror = true;
            }
            this.courses = response.data.courses;
            this.top_layers = response.data.top_layers;
            this.mid_layers = response.data.mid_layers;
            this.less_layers = response.data.less_layers;
            this.videos = response.data.videos;
            this.questions = response.data.questions;
          })
          .catch((error) => {
            this.courses = error.response.data.courses;
            this.top_layers = error.response.data.top_layers;
            this.mid_layers = error.response.data.mid_layers;
            this.less_layers = error.response.data.less_layers;
            this.videos = error.response.data.videos;
            this.questions = error.response.data.questions;
            this.onerror = true;
            this.toast.error(error.response.data.message)
            Object.values(error.response.data.errors)
                .flat()
                .forEach((element) => this.toast.error(element));
          })
          .finally(() => {
            this.loading = false;
            this.disable = false
          });
    },
  },
};
</script>
