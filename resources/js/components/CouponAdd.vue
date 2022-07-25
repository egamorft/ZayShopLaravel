<template>
  <div class="container">
    <div class="col-lg-11">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Add coupon</h6>
            </div>
            <div class="col-lg-6 col-5 my-auto text-end">
              <div class="dropdown float-lg-end pe-4">
                <a
                  class="cursor-pointer"
                  id="dropdownTable"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="fa fa-ellipsis-v text-secondary"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="col-md-7 container">
            <form @submit.prevent="saveCoupon" role="form">
              <div
                class="input-group input-group-outline d-flex"
                :class="{ 'focused is-focused': focus }"
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
              <div class="input-group input-group-outline my-3">
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
              <div class="input-group input-group-outline my-3">
                <label class="form-label"> Coupon Time </label>
                <input
                  name="coupon_time"
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
              <div class="input-group input-group-outline my-3">
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
              <div class="text-center">
                <button
                  type="submit"
                  class="btn bg-gradient-primary w-100 my-4 mb-2"
                >
                  Add coupon
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      coupon: {
        coupon_name: "",
        coupon_code: "",
        coupon_time: "",
        coupon_condition: "1",
        coupon_number: "",
      },
      errors: {},
      focus: false,
    };
  },
  methods: {
    saveCoupon: function () {
      let formData = new FormData();
      formData.append("coupon_name", this.coupon.coupon_name);
      formData.append("coupon_code", this.coupon.coupon_code);
      formData.append("coupon_time", this.coupon.coupon_time);
      formData.append("coupon_condition", this.coupon.coupon_condition);
      formData.append("coupon_number", this.coupon.coupon_number);

      axios
        .post("save-coupon", formData)
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
          setTimeout(function () {
            window.location.reload();
          }, 3000);
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log(error);
        });
    },
    generateCode: function () {
      this.focus = true;
      this.coupon.coupon_code = Math.random()
        .toString(36)
        .slice(2)
        .substring(0, 5)
        .toUpperCase();
    },
  },
};
</script>
