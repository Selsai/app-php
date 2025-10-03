

<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["plat"])) {
    $choixPlat = htmlspecialchars($_POST["plat"]);
    $message = "Vous avez choisi le plat : $choixPlat";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Dropdown Plat Stylé</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animation fade-in */
        .fade-in {
            animation: fadein 0.8s ease forwards;
        }
        @keyframes fadein {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #a78bfa;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white rounded-3xl shadow-2xl p-10 max-w-md w-full">
        <h1 class="text-4xl font-extrabold text-purple-800 mb-8 text-center tracking-wide select-none">Choix du plat au restaurant</h1>

        <form method="post" action="" class="space-y-6">
            <label for="customDropdown" class="block text-lg font-semibold text-gray-700 mb-2">
                Sélectionnez un plat délicieux :
            </label>

            <!-- Dropdown Container -->
            <div x-data="dropdown()" x-init="init()" class="relative" x-cloak>
                <!-- Input box to display currently selected -->
                <button type="button"
                    @click="toggle()"
                    @keydown.escape="close()"
                    @keydown.arrow-down.prevent="next()"
                    @keydown.arrow-up.prevent="prev()"
                    aria-haspopup="listbox"
                    aria-expanded="false"
                    id="customDropdown"
                    class="w-full cursor-pointer rounded-2xl border border-purple-300 bg-purple-50 px-5 py-3 text-left text-lg font-medium text-purple-700 shadow-sm hover:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 flex justify-between items-center">
                    <span x-text="selectedLabel || 'Choisissez un plat...'"></span>
                    <svg class="h-5 w-5 text-purple-500 transform transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <ul
                    x-show="open"
                    @click.away="close()"
                    @keydown.arrow-down.prevent="next()"
                    @keydown.arrow-up.prevent="prev()"
                    @keydown.enter.prevent="selectOption()"
                    tabindex="-1"
                    role="listbox"
                    aria-labelledby="customDropdown"
                    class="absolute z-20 mt-2 max-h-52 w-full overflow-auto rounded-xl border border-purple-300 bg-white shadow-lg focus:outline-none scrollbar-thin scrollbar-thumb-purple-400 scrollbar-track-purple-50"
                    style="display: none;">
                    <template x-for="(option,index) in filteredOptions()" :key="option.value">
                        <li
                            @mouseenter="activeIndex = index"
                            @mouseleave="activeIndex = -1"
                            @click="select(option)"
                            :class="{'bg-purple-200 text-purple-900': index === activeIndex, 'text-purple-700': index !== activeIndex}"
                            role="option"
                            :aria-selected="index === activeIndex ? 'true' : 'false'"
                            class="cursor-pointer px-6 py-3 text-lg transition-colors duration-150 rounded-lg select-none">
                            <span x-text="option.emoji"></span> <span x-text="option.label"></span>
                        </li>
                    </template>
                    <template x-if="filteredOptions().length === 0">
                        <li class="px-6 py-3 text-center text-gray-400 select-none">Aucun plat trouvé</li>
                    </template>
                </ul>
                <input type="hidden" name="plat" :value="selectedValue" required />
            </div>

            <button type="submit"
                    class="w-full rounded-full bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-600 text-white font-bold py-3 text-lg shadow-lg hover:from-pink-600 hover:via-purple-700 hover:to-indigo-700 transition-transform active:scale-95">
                Confirmer mon choix
            </button>
        </form>

        <?php if ($message): ?>
            <p class="mt-8 text-center text-xl font-semibold text-purple-700 fade-in select-none"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>

    <!-- Alpine.js for dropdown behavior -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function dropdown() {
            return {
                open: false,
                selectedValue: '',
                selectedLabel: '',
                activeIndex: -1,
                options: [
                    { value: 'Pizza', label: 'Pizza', emoji: '🍕' },
                    { value: 'Pâtes', label: 'Pâtes', emoji: '🍝' },
                    { value: 'Salade', label: 'Salade', emoji: '🥗' },
                    { value: 'Steak', label: 'Steak', emoji: '🥩' },
                    { value: 'Poisson', label: 'Poisson', emoji: '🐟' },
                ],
                filteredOptions() {
                    return this.options;
                },
                toggle() {
                    this.open = !this.open;
                    if (this.open) this.$nextTick(() => this.focusDropdown());
                },
                close() {
                    this.open = false;
                    this.activeIndex = -1;
                },
                select(option) {
                    this.selectedValue = option.value;
                    this.selectedLabel = option.label;
                    this.close();
                },
                selectOption() {
                    if(this.activeIndex >= 0) {
                        this.select(this.options[this.activeIndex]);
                    }
                },
                next() {
                    if(this.activeIndex < this.options.length - 1) {
                        this.activeIndex++;
                    } else {
                        this.activeIndex = 0;
                    }
                    this.scrollToActive();
                },
                prev() {
                    if(this.activeIndex > 0) {
                        this.activeIndex--;
                    } else {
                        this.activeIndex = this.options.length - 1;
                    }
                    this.scrollToActive();
                },
                scrollToActive() {
                    this.$nextTick(() => {
                        const list = this.$el.querySelector("ul");
                        const item = list.children[this.activeIndex];
                        if(item) {
                            const listRect = list.getBoundingClientRect();
                            const itemRect = item.getBoundingClientRect();
                            if(itemRect.bottom > listRect.bottom) {
                                list.scrollTop += itemRect.bottom - listRect.bottom;
                            } else if(itemRect.top < listRect.top) {
                                list.scrollTop -= listRect.top - itemRect.top;
                            }
                        }
                    });
                },
                init() {
                    // Initialize with first option selected if already POST-ed (optional)
                    const val = '<?php echo isset($_POST["plat"]) ? addslashes(htmlspecialchars($_POST["plat"])) : ""; ?>';
                    if (val) {
                        const opt = this.options.find(o => o.value === val);
                        if(opt) {
                            this.selectedValue = opt.value;
                            this.selectedLabel = opt.label;
                        }
                    }
                },
                focusDropdown() {
                    this.$el.querySelector("ul").focus();
                }
            }
        }
    </script>
</body>
</html>