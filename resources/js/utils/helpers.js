//Get Money Text
export const getMoneyText = (value) => {
    if (isNaN(value)) return "₱0.00";

    return new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }).format(value);
};
