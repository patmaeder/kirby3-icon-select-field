<template>
  <div>
    <k-field :label="label" :required="required" :help="help" >
      <k-dropdown class="sx-icon-dropdown">
        <div class="k-input" data-theme="field">
          <k-button @click="toggleDropdown" class="sx-icon-dropdown-button">
              <div>
                <img v-if="value" :src="path + value" >
                <k-icon v-if="!value" type="image" />
              </div>
              <span>{{ value }}</span>
              <k-icon type="angle-down" />
          </k-button>
        </div>
        <k-dropdown-content ref="dropdown" class="sx-icon-dropdown-content">
          <div class="sx-icon-dropdown-content-search">
            <k-icon type="search"></k-icon>
            <input type="text" v-model="query" placeholder="Suche ..." ref="search" @submit="event.preventDefault()">
          </div>
          <div class="sx-icon-dropdown-content-icons">
            <div v-for="icon in result" :key="icon" @click="setIcon(icon)">
              <img :src="path + icon" >
              <span>{{ icon }}</span>
            </div>
          </div>
        </k-dropdown-content>
      </k-dropdown>
    </k-field>
  </div>
</template>

<script>
export default {
  props: {
    label: String,
    required: Boolean,
    help: String,
    value: String,
    path: String,
    icons: String
  },
  data() {
    return {
      query: undefined,
    }
  },
  computed: {
    result() {
      if (this.query == undefined) {
        return this.icons
      } else {
        return this.icons.filter((x) => x.includes(this.query.toLowerCase()));
      }
    }
  },
  methods: {
    toggleDropdown() {
      this.query = undefined;
      this.$refs.dropdown.toggle();
      if (this.$refs.search == undefined) {
        setTimeout(() => {
          this.$refs.search.focus()
        }, 50);
      }
    },
    setIcon(icon) {
      this.$refs.dropdown.toggle();
      this.$emit("input", icon);
    }
  } 
};
</script>

<style>
.sx-icon-dropdown {
  width: 100%;
  display: block;
}

.sx-icon-dropdown-button {
  display: flex;
  position: relative;
  width: 100%;
  height: 36px;
  padding: 0.25rem 2rem 0 0.25rem;
  min-height: 2.25rem;
}

.sx-icon-dropdown-button .k-button-text {
  display: flex;
  opacity: 1;
}

.sx-icon-dropdown-button .k-button-text div {
  height: 36px;
  width: 36px;
  padding: 6px;
  border-right: 1px solid var(--color-border);
  transform: translate(-4px, -4px);
  margin-right: 6px;
}

.sx-icon-dropdown-button .k-button-text div img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.sx-icon-dropdown-button .k-button-text div .k-icon {
  opacity: .3;
}

.sx-icon-dropdown-button .k-button-text span:first-of-type {
  height: 26px;
  display: flex;
  align-items: center;
  font-weight: var(--font-normal);
  font-size: var(--font-size-medium);
  color: var(--color-text);
}

.sx-icon-dropdown-button .k-button-text > .k-icon {
  position: absolute;
  right: 0;
  top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
}

.sx-icon-dropdown-content {
  width: 100%;
}

.sx-icon-dropdown-content-search{
  display: flex;
  width: 100%;
  height: 40px;
  padding: 6px 16px;
  background-color: var(--color-gray-900);
  border-bottom: 1px dashed rgba(255,255,255,.2);
}

.sx-icon-dropdown-content-search input{
  flex-grow: 1;
  padding-left: 8px;
  outline: none;
  border: none;
  background: transparent;
  color: var(--color-white);
}

.sx-icon-dropdown-content-icons {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(160px, 100%), 1fr));
  max-height: 600px;
  overflow: auto;
}

.sx-icon-dropdown-content-icons div {
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;
  border: 0.5px solid var(--color-gray-800);
  padding: 14px 0;
}

.sx-icon-dropdown-content-icons img {
  width: 24px;
  height: 24px;
  object-fit: contain;
  filter: invert(1);
  margin-bottom: 6px;
}
</style>
