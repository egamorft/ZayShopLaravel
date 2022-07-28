<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div
              class="
                bg-gradient-primary
                shadow-primary
                border-radius-lg
                pt-4
                pb-3
              "
            >
              <h6 class="text-white text-capitalize ps-3">Slider table</h6>
            </div>
          </div>
          <div class="col-11 text-end">
            <button
              @click="openAdd()"
              data-bs-toggle="modal"
              data-bs-target="#staticBackdrop"
              class="btn bg-gradient-dark mb-0"
            >
              <i class="material-icons text-sm"> add </i>&nbsp;&nbsp; Add Slider
            </button>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="filterTable">
                <thead>
                  <tr>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                      "
                    >
                      ID
                    </th>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                        ps-2
                      "
                    >
                      Slider Name
                    </th>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                        ps-2
                      "
                    >
                      Slider Image
                    </th>
                    <th
                      class="
                        text-center text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                      "
                    >
                      Show/Hide
                    </th>
                    <th class="text-secondary opacity-7"></th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody v-if="sliders != ''">
                  <tr v-for="(slider, index) in sliders" v-bind:key="index">
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="justify-content-center">
                          {{ slider.slider_id }}
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">
                        {{ slider.slider_name }}
                      </p>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">
                        <img
                          v-bind:src="
                            'public/upload/slider/' + slider.slider_image
                          "
                          width="45%"
                          alt="No image available"
                        />
                      </p>
                    </td>

                    <td
                      class="align-middle text-center"
                      v-if="slider.slider_status == 1"
                    >
                      <a
                        type="button"
                        @click="inactiveSlider(slider.slider_id)"
                      >
                        <i
                          class="material-icons"
                          style="font-size: 40px; color: green"
                        >
                          thumb_up
                        </i>
                      </a>
                    </td>

                    <td class="align-middle text-center" v-else>
                      <a type="button" @click="activeSlider(slider.slider_id)">
                        <i
                          class="material-icons"
                          style="font-size: 40px; color: red"
                        >
                          thumb_down
                        </i>
                      </a>
                    </td>
                    <td class="align-middle">
                      <a
                        type="button"
                        @click="editSlider(slider)"
                        data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"
                        class="font-weight-bold"
                        data-toggle="tooltip"
                      >
                        <i class="material-icons" style="font-size: 30px">
                          edit
                        </i>
                      </a>
                    </td>
                    <td class="align-middle">
                      <a
                        type="button"
                        @click="deleteSliders(slider.slider_id)"
                        class="font-weight-bold"
                        data-toggle="tooltip"
                      >
                        <i class="material-icons" style="font-size: 30px">
                          delete
                        </i>
                      </a>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <td colspan="6">
                    <center>
                      <h3>Nothing here</h3>
                    </center>
                  </td>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div div="row">
          <ul class="pagination pagination-lg justify-content-center">
            <li
              class="page-item"
              v-bind:class="[{ disabled: !pagination.prev_page_url }]"
              :disable="!pagination.prev_page_url"
            >
              <a
                class="page-link"
                href="#"
                @click="fetchSliders(pagination.prev_page_url)"
                rel="prev"
                aria-label="&laquo; Previous"
                >&lsaquo;</a
              >
            </li>

            <li class="page-item disabled">
              <a
                class="
                  page-link
                  active
                  rounded-0
                  mr-3
                  shadow-sm
                  border-top-0 border-left-0
                "
                href="#"
              >
                {{ pagination.current_page }} / {{ pagination.last_page }}
              </a>
            </li>

            <li
              class="page-item"
              v-bind:class="[{ disabled: !pagination.next_page_url }]"
              :disable="!pagination.next_page_url"
            >
              <a
                class="page-link"
                href="#"
                @click="fetchSliders(pagination.next_page_url)"
                rel="next"
                aria-label="Next &raquo;"
                >&rsaquo;</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="staticBackdrop"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <form @submit.prevent="saveSlider">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                Slider: #{{ slider.slider_id }}
              </h5>
              <a type="button">
                <i class="material-icons text-xl" data-bs-dismiss="modal"
                  >close</i
                >
              </a>
            </div>
            <div class="modal-body">
              <div
                class="input-group input-group-outline my-3"
                :class="{ 'focused is-focused': focusAll }"
              >
                <label class="form-label"> Slider Name </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="slider.slider_name"
                />
              </div>
              <span style="color: red" v-if="errors && errors.slider_name">
                {{ errors.slider_name[0] }}
              </span>
              <div class="input-group input-group-outline mb-3">
                <div class="col-md-3">
                  <span class="form-label"> Slider Image </span>
                </div>
                <div class="col-md-9">
                  <input
                    type="file"
                    class="form-control"
                    @change="onFileChange"
                    ref="fileUpload"
                  />
                </div>
              </div>
              <center id="preview" v-if="!edit">
                <img
                  v-if="slider.slider_image"
                  :src="previewImage"
                  width="500"
                />
              </center>
              <center id="preview" v-else>
                <img
                  v-if="slider.slider_image"
                  v-bind:src="'public/upload/slider/' + slider.slider_image"
                  width="500"
                />
              </center>
              <span style="color: red" v-if="errors && errors.slider_image">
                {{ errors.slider_image[0] }}
              </span>
              <br />
              <label class="form-label" for="ckeditorAdd">
                Slider Description
              </label>
              <div class="input-group input-group-outline mb-3">
                <ckeditor
                  :editor="editor"
                  v-model="slider.slider_desc"
                ></ckeditor>
              </div>
              <span style="color: red" v-if="errors && errors.slider_desc">
                {{ errors.slider_desc[0] }}
              </span>
              <div class="form-check mb-3">
                <label class="form-check-label" for="show"> Show </label>
                <input
                  class="form-check-input"
                  type="radio"
                  id="show"
                  value="1"
                  v-model="slider.slider_status"
                />

                <label class="form-check-label" for="hide"> Hide </label>
                <input
                  class="form-check-input"
                  type="radio"
                  id="hide"
                  value="0"
                  v-model="slider.slider_status"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- End Modal -->
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  data() {
    return {
      editor: ClassicEditor,
      previewImage: "",
      sliders: [],
      slider: {
        slider_id: "",
        slider_name: "",
        slider_image: "",
        slider_desc: "",
        slider_status: "",
      },
      slider_id: "",
      pagination: {},
      edit: false,
      errors: {},
      focusAll: false,
    };
  },
  created() {
    this.fetchSliders();
  },
  methods: {
    onFileChange(e) {
      const file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
        var filename = this.$refs.fileUpload.value.replace(/^.*\\/, "");
      this.slider.slider_image = filename;
    },
    fetchSliders: function (page_url) {
      let vm = this;
      page_url = page_url || "api/sliders";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.sliders = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch((err) => console.log(err));
    },
    makePagination: function (meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        path: meta.path,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };
      this.pagination = pagination;
    },
    deleteSliders: function (id) {
      Swal.fire({
        title: "Delete slider #" + id + "?",
        showClass: {
          popup: "animate__animated animate__fadeInDown",
        },
        hideClass: {
          popup: "animate__animated animate__fadeOutUp",
        },
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("api/sliders/" + id)
            .then((res) => {
              Swal.fire(
                "Deleted!",
                "Slider #" + id + " has been deleted.",
                "success"
              );
              this.fetchSliders(
                this.pagination.path + "?page=" + this.pagination.current_page
              ); // fetch keep pages
            })
            .catch((err) => console.log(err));
        }
      });
    },
    saveSlider: function () {
      if (this.edit === false) {
        //add slider
        let formData = new FormData();
        formData.append("slider_name", this.slider.slider_name);
        formData.append("slider_image", this.slider.slider_image);
        formData.append("slider_desc", this.slider.slider_desc);
        formData.append("slider_status", this.slider.slider_status);

        axios
          .post("api/sliders", formData,{headers: {
                    'Content-Type': 'multipart/form-data'
                }})
          .then((response) => {
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "success",
              title: "Add successfully",
            });
            // alert
            this.errors = "";
            $("#staticBackdrop").modal("hide");
            this.fetchSliders();
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "error",
              title: "Oops! Something went wrong",
            });
            // alert
          });
      } else {
        //edit slider
        axios
          .put(`api/sliders/${this.slider.slider_id}`, {
            slider_name: this.slider.slider_name,
            slider_desc: this.slider.coupon_desc,
            slider_image: this.slider.coupon_image,
            coupon_status: this.slider.coupon_status,
          })
          .then((res) => {
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "success",
              title: "Update successfully",
            });
            // alert
            this.errors = "";
            $("#staticBackdrop").modal("hide");
            this.fetchSliders(
              this.pagination.path + "?page=" + this.pagination.current_page
            ); // fetch keep pages
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "error",
              title: "Oops! Something went wrong",
            });
            // alert
          });
      }
    },
    editSlider: function (slider) {
      this.edit = true;
      this.focusAll = true;
      this.slider.slider_id = slider.slider_id;
      this.slider.slider_name = slider.slider_name;
      this.slider.slider_image = slider.slider_image;
      this.slider.slider_desc = slider.slider_desc;
      this.slider.slider_status = slider.slider_status;
      this.errors = "";
    },
    openAdd: function () {
      this.edit = false;
      this.$refs.fileUpload.value = null;
      this.focusAll = false;
      this.slider.slider_id = "";
      this.slider.slider_name = "";
      this.slider.slider_image = "";
      this.slider.slider_desc = "";
      this.slider.slider_status = "1";
      this.errors = "";
    },
  },
};
</script>