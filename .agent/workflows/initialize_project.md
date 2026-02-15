---
description: Initialize GlobalConnect WordPress Project
---

1. Create Child Theme Directory
   - Path: `C:\Users\Lenovo\Local Sites\globalconnect\app\public\wp-content\themes\globalconnect-child`

2. Create Child Theme Files
   - `style.css`: Define theme metadata and import parent styles.
   - `functions.php`: Enqueue parent/child styles.

3. Setup Custom Post Types
   - Create `C:\Users\Lenovo\Local Sites\globalconnect\app\public\wp-content\themes\globalconnect-child\includes\post-types` directory.
   - Create `vehicle-post-type.php` to register the Vehicle CPT.
   - Include `vehicle-post-type.php` in `functions.php`.

4. Setup Assets
   - Create `C:\Users\Lenovo\Local Sites\globalconnect\app\public\wp-content\themes\globalconnect-child\assets\css`
   - Create `C:\Users\Lenovo\Local Sites\globalconnect\app\public\wp-content\themes\globalconnect-child\assets\js`
