<?php
// Ye do lines errors ko screen par dikha dengi
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Baaki ka aapka code yahan se shuru...
<!-- index.php me HTML/CSS bilkul same rahega -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS, Title aur Scripts ko wahi rakhein jo index.html me the -->
    <meta charset="UTF-8">
    <title>Top Style Pivot Dashboard</title>
    <!-- ... (Aapka CSS yahan) ... -->
</head>
<body>
    <!-- ... (Aapka HTML yahan) ... -->
    
    <!-- Supabase JS hatakar, direct PHP fetch use karenge -->
    <script>
        // JS Variables and Helper Functions (same as before)
        // ... toggleFilters(), formatDateToYYYYMMDD() ...

        async function fetchAndRender() {
            const msg = document.getElementById('load-msg');
            msg.innerText = "Data load ho raha hai...";

            let startD = '', endD = '';
            const dates = fpInstance.selectedDates;
            if (dates.length >= 1) {
                startD = formatDateToYYYYMMDD(dates[0]);
                endD = dates.length === 2 ? formatDateToYYYYMMDD(dates[1]) : startD;
            }

            try {
                // AB HUM DIRECT PHP API KO CALL KARENGE
                const response = await fetch(`api_fetch.php?start_date=${startD}&end_date=${endD}`);
                const result = await response.json();

                if (result.error) throw new Error(result.error);

                rawData = result.data || [];
                populateFilterOptions();
                processAndRenderTable();
            } catch (err) {
                console.error(err);
                document.getElementById('table-body').innerHTML = `<tr><td class="loading" style="color:red;">Error: ${err.message}</td></tr>`;
            }
        }
        
        // ... (processAndRenderTable aur export functions same rahenge) ...
    </script>
</body>
</html>
