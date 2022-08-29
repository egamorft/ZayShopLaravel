<template>
  <div v-if="addresses != ''">
    <div
      class="d-flex my-4 flex-wrap justify-content-between"
      v-for="(address, index) in addresses"
      v-bind:key="index"
    >
      <div class="p-2">
        <div>
          {{ address.specific_address }}
        </div>
        <div>
          {{ address.ward_address.name_xaphuong }},
          {{ address.province_address.name_quanhuyen }},
          {{ address.city_address.name_city }}
        </div>
        <div class="d-flex my-4 flex-wrap" v-if="address.is_default == true">
          <div id="default">Default</div>
        </div>
      </div>
      <div class="p-2"></div>
      <div class="p-2">
        <a type="button" href="" class="btn btn-outline-success">Update</a>
        <a
          type="button"
          href=""
          class="btn btn-outline-success"
          v-if="address.is_default != true"
          >Delete address</a
        >
        <div class="d-flex my-4 flex-wrap">
          <button
            disabled
            type="button"
            href=""
            class="btn btn-outline-dark"
            v-if="address.is_default == true"
          >
            Set as default
          </button>
          <button type="button" href="" class="btn btn-outline-success" v-else>
            Set as default
          </button>
        </div>
      </div>
    </div>
    <hr>
  </div>
  <div class="p-2" v-else>You have no address yet</div>
</template>

<script>
export default {
  data() {
    return {
      addresses: [],
      address: {
        address_id: "",
        account_id: "",
        specific_address: "",
        address_type: "",
        is_default: "",
        coupon_code: "",
      },
      edit: false,
      errors: {},
      focusCode: false,
      focusAll: false,
    };
  },
  created() {
    this.fetchAddresses();
  },
  methods: {
    fetchAddresses: function (page_url) {
      page_url = page_url || "../api/address";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.addresses = res.data;
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>