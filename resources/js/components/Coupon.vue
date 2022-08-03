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
              <h6 class="text-white text-capitalize ps-3">Coupon table</h6>
            </div>
          </div>
          <div class="col-11 text-end">
            <button
              @click="openAdd()"
              data-bs-toggle="modal"
              data-bs-target="#staticBackdrop"
              class="btn bg-gradient-dark mb-0"
            >
              <i class="material-icons text-sm"> add </i>&nbsp;&nbsp; Add Coupon
            </button>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
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
                      Coupon Name
                    </th>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                        ps-2
                      "
                    >
                      Coupon Code
                    </th>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                      "
                    >
                      Coupon Time
                    </th>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                        ps-2
                      "
                    >
                      Coupon Condition
                    </th>
                    <th
                      class="
                        text-uppercase text-secondary
                        font-weight-bolder
                        opacity-7
                        ps-2
                      "
                    >
                      Coupon Number
                    </th>
                    <th class="text-secondary opacity-7"></th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody v-if="coupons != ''">
                  <tr v-for="(coupon, index) in coupons" v-bind:key="index">
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="justify-content-center">
                          {{ coupon.coupon_id }}
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">
                        {{ coupon.coupon_name }}
                      </p>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">
                        {{ coupon.coupon_code }}
                      </p>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">
                        {{ coupon.coupon_time }}
                      </p>
                    </td>
                    <td v-if="coupon.coupon_condition == 1">
                      <p class="font-weight-bold mb-0">Sale by %</p>
                    </td>
                    <td v-else>
                      <p class="font-weight-bold mb-0">Sale by VND</p>
                    </td>
                    <td v-if="coupon.coupon_condition == 1">
                      <p class="font-weight-bold mb-0">
                        Sale {{ coupon.coupon_number }}%
                      </p>
                    </td>
                    <td v-else>
                      <p class="font-weight-bold mb-0">
                        Sale
                        {{ number_format(coupon.coupon_number, ",", ".") }} VND
                      </p>
                    </td>
                    <td class="align-middle">
                      <a
                        type="button"
                        @click="editCoupon(coupon)"
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
                        @click="deleteCoupons(coupon.coupon_id)"
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
                  <td colspan="7">
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
                @click="fetchCoupons(pagination.prev_page_url)"
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
                @click="fetchCoupons(pagination.next_page_url)"
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
      <div class="modal-dialog">
        <form @submit.prevent="saveCoupon">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                Coupon: #{{ coupon.coupon_id }}
              </h5>
              <a type="button">
                <i class="material-icons text-xl" data-bs-dismiss="modal"
                  >close</i
                >
              </a>
            </div>
            <div class="modal-body">
              <div
                class="input-group input-group-outline d-flex"
                :class="{ 'focused is-focused': focusCode }"
              >
                <label class="form-label"> Coupon Code </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="coupon.coupon_code"
                />
              </div>
              <span style="color: red" v-if="errors && errors.coupon_code">
                {{ errors.coupon_code[0] }}
              </span>
              <br />
              <input
                @click="generateCode()"
                class="btn btn-success"
                type="button"
                value="Generate random code"
              />
              <div
                class="input-group input-group-outline my-3"
                :class="{ 'focused is-focused': focusAll }"
              >
                <label class="form-label"> Coupon Name </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="coupon.coupon_name"
                />
              </div>
              <span style="color: red" v-if="errors && errors.coupon_name">
                {{ errors.coupon_name[0] }}
              </span>
              <div
                class="input-group input-group-outline my-3"
                :class="{ 'focused is-focused': focusAll }"
              >
                <label class="form-label"> Coupon Time </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="coupon.coupon_time"
                />
              </div>
              <span style="color: red" v-if="errors && errors.coupon_time">
                {{ errors.coupon_time[0] }}
              </span>
              <div class="input-group input-group-outline mb-3">
                <select class="form-control" v-model="coupon.coupon_condition">
                  <option value="1" selected>Discount by percentage</option>
                  <option value="2">Discount by money</option>
                </select>
              </div>
              <div
                class="input-group input-group-outline my-3"
                :class="{ 'focused is-focused': focusAll }"
              >
                <label class="form-label"> Enter % or number of sale </label>
                <input
                  type="text"
                  class="form-control"
                  v-model="coupon.coupon_number"
                />
              </div>
              <span style="color: red" v-if="errors && errors.coupon_number">
                {{ errors.coupon_number[0] }}
              </span>
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
export default {
  data() {
    return {
      coupons: [],
      coupon: {
        coupon_id: "",
        coupon_name: "",
        coupon_time: "",
        coupon_condition: "1",
        coupon_number: "",
        coupon_code: "",
      },
      coupon_id: "",
      pagination: {},
      edit: false,
      errors: {},
      focusCode: false,
      focusAll: false,
    };
  },
  created() {
    this.fetchCoupons();
  },
  methods: {
    fetchCoupons: function (page_url) {
      let vm = this;
      page_url = page_url || "api/coupons";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.coupons = res.data;
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
    deleteCoupons: function (id) {
      Swal.fire({
        title: "Delete coupon #" + id + "?",
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
            .delete("api/coupons/" + id)
            .then((res) => {
              Swal.fire(
                "Deleted!",
                "Coupon #" + id + " has been deleted.",
                "success"
              );
              this.fetchCoupons(
                this.pagination.path + "?page=" + this.pagination.current_page
              ); // fetch keep pages
            })
            .catch((err) => console.log(err));
        }
      });
    },
    saveCoupon: function () {
      if (this.edit === false) {
        //add coupon
        let formData = new FormData();
        formData.append("coupon_name", this.coupon.coupon_name);
        formData.append("coupon_code", this.coupon.coupon_code);
        formData.append("coupon_time", this.coupon.coupon_time);
        formData.append("coupon_condition", this.coupon.coupon_condition);
        formData.append("coupon_number", this.coupon.coupon_number);

        axios
          .post("api/coupons", formData)
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
            this.fetchCoupons();
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
        //edit coupon
        axios
          .put(`api/coupons/${this.coupon.coupon_id}`, {
            coupon_name: this.coupon.coupon_name,
            coupon_time: this.coupon.coupon_time,
            coupon_condition: this.coupon.coupon_condition,
            coupon_number: this.coupon.coupon_number,
            coupon_code: this.coupon.coupon_code,
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
            this.fetchCoupons(
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
    generateCode: function () {
      if (this.focusCode === false) {
        this.focusCode = true;
      }
      this.coupon.coupon_code = Math.random()
        .toString(36)
        .slice(2)
        .substring(0, 5)
        .toUpperCase();
    },
    editCoupon: function (coupon) {
      if (this.edit === false) {
        this.edit = true;
      }
      if (this.focusCode === false) {
        this.focusCode = true;
      }
      if(this.focusAll === false){
        this.focusAll = true;
      }
      this.coupon.coupon_id = coupon.coupon_id;
      this.coupon.coupon_name = coupon.coupon_name;
      this.coupon.coupon_time = coupon.coupon_time;
      this.coupon.coupon_condition = coupon.coupon_condition;
      this.coupon.coupon_number = coupon.coupon_number;
      this.coupon.coupon_code = coupon.coupon_code;
      this.errors = "";
    },
    openAdd: function () {
      if(this.edit === true){
        this.edit = false;
      }
      if(this.focusCode === true){
        this.focusCode = false;
      }
      if(this.focusAll === true){
        this.focusAll = false;
      }
      this.coupon.coupon_id = "";
      this.coupon.coupon_name = "";
      this.coupon.coupon_time = "";
      this.coupon.coupon_number = "";
      this.coupon.coupon_code = "";
      this.errors = "";
    },
  },
};
</script>