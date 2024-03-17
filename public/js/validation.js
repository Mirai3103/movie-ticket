const validations = {
  required: (value) => value && value.trim() !== "",
  email: (value) => /\S+@\S+\.\S+/.test(value),
  minLength: (value, length) => value.length >= length,
  maxLength: (value, length) => value.length <= length,
  number: (value) => !isNaN(value),
  min: (value, min) => value >= min,
  max: (value, max) => value <= max,
  pattern: (value, pattern) => new RegExp(pattern).test(value),
};

class Validator {
  constructor() {
    this.validationRules = {};
  }

  /**
   * rules
   * @typedef {Object} Rule
   * @property {string} value - Giá trị cần so sánh
   * @property {string} message - Thông báo lỗi
   */
  /**
   * Đăng ký một trường cần kiểm tra
   * @param {string} field - Tên trường cần kiểm tra
   * @param {Object.<string, Rule>} rules - Danh sách các quy tắc kiểm tra
   */
  register(field, rules) {
    if (!this.validationRules[field]) {
      this.validationRules[field] = [];
    }
    Object.keys(rules).forEach((ruleName) => {
      const ruleConfig = rules[ruleName];
      const validationFunction = validations[ruleName];
      if (validationFunction) {
        this.validationRules[field].push({
          validationFunction,
          ruleConfig,
        });
      }
    });
  }
  validate(data) {
    const errors = {};
    Object.keys(data).forEach((field) => {
      if (this.validationRules[field]) {
        this.validationRules[field].forEach((rule) => {
          const { validationFunction, ruleConfig } = rule;
          const isValid = validationFunction(data[field], ruleConfig.value);
          if (!isValid) {
            if (!errors[field]) {
              errors[field] = [];
            }
            errors[field].push(ruleConfig.message || "Trường này không hợp lệ");
          }
        });
      }
    });
    return errors;
  }
  validateField(field, value) {
    const rules = this.validationRules[field];
    const errors = [];
    if (rules) {
      rules.forEach((rule) => {
        const { validationFunction, ruleConfig } = rule;
        const isValid = validationFunction(value, ruleConfig.value);
        if (!isValid) {
          errors.push(ruleConfig.message || "Trường này không hợp lệ");
        }
      });
    }
    return errors;
  }
}

export class FormValidator extends Validator {
  constructor() {
    super();
  }
  register(field, rules, validateOn = "input") {
    super.register(field, rules);
    document.getElementById(field).addEventListener(validateOn, (e) => {
      const errors = super.validateField(field, e.target.value);
      const errorElement = document.getElementById(`${field}-error`);
      if (errors.length) {
        errorElement.innerText = errors.join(", ");
        errorElement.style.display = "block";
      } else {
        errorElement.innerText = "";
        errorElement.setAttribute("hidden", "true");
      }
    });
  }
}

if (window.Alpine) {
  Alpine.data("formValidator", (validationRules) => {
    return {
      errors: {},
      data: {},
      validate: null,
      init() {
        this.validator = new Validator();
        Object.keys(validationRules).forEach((field) => {
          this.validator.register(field, validationRules[field]);
          this.data[field] = "";
          document.getElementById(field)?.addEventListener("focus", (e) => {
            this.errors[field] = [];
          });
        });
        this.validate = () => {
          console.log(this.data);
          console.log(this.validator.validate(this.data));
          this.errors = this.validator.validate(this.data);
        };
      },
    };
  });
}