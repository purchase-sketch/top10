<!-- upload.php me HTML same rahega -->
<script>
    // ... cleanDateValue() function same rahega ...

    async function uploadData() {
        // ... Data array banane tak ka logic (insertData = []) same rahega ...
        
        // --- PHP ko bhejne ka naya logic ---
        try {
            const response = await fetch('api_upload.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ rows: insertData })
            });
            
            const result = await response.json();
            
            if (result.success) {
                status.textContent = "✅ " + result.message;
                status.style.color = "green";
                document.getElementById('tsvData').value = ''; 
            } else {
                throw new Error(result.message);
            }
        } catch (err) {
            console.error(err);
            status.textContent = "❌ Error: " + err.message;
            status.style.color = "red";
        }
        
        btn.disabled = false;
    }
</script>