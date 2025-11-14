# Tailwind CDN to Layout Conversion Guide

## Status: 38% Complete (11/29 files)

### ✅ COMPLETED FILES (11)
These files now properly use `main.php` layout with compiled Tailwind CSS:
- auth/login.php
- auth/register.php
- author/dashboard.php
- home/index.php
- home/about.php
- home/contact.php
- home/faq.php
- home/search.php
- home/editorial-board.php
- home/current-issues.php
- home/submission-guidelines.php

### ⏳ REMAINING FILES (18)

## CONVERSION PATTERN

All remaining files need this conversion:

### BEFORE (Wrong):
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Page Title</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = {...}</script>
</head>
<body>
    <?php include 'navigation.php'; ?>
    
    <!-- Page content here -->
    
    <?php include 'footer.php'; ?>
</body>
</html>
```

### AFTER (Correct):
```php
<?php
$title = 'Page Title';
$description = 'Page description';
$keywords = 'keywords';

ob_start();
?>

<!-- Page content here (no navigation/footer includes) -->

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
```

## FILES TO CONVERT

### Admin Files (4)
- [ ] resources/views/admin/dashboard.php
- [ ] resources/views/admin/users.php
- [ ] resources/views/admin/submissions.php
- [ ] resources/views/admin/categories.php

**Note**: Also convert Bootstrap classes to Tailwind:
- `.container` → `.container mx-auto px-4`
- `.row` → `.grid grid-cols-...` or `.flex`
- `.col-md-6` → `.md:w-1/2` or grid column classes
- `.btn btn-primary` → `.btn-primary` (our custom class)

### Editor Files (3)
- [ ] resources/views/editor/dashboard.php
- [ ] resources/views/editor/submissions.php
- [ ] resources/views/editor/view-submission.php

### Reviewer Files (4)
- [ ] resources/views/reviewer/dashboard.php
- [ ] resources/views/reviewer/submissions.php
- [ ] resources/views/reviewer/history.php
- [ ] resources/views/reviewer/view-submission.php

### Author Files (3)
- [ ] resources/views/author/submit.php
- [ ] resources/views/author/manage.php
- [ ] resources/views/author/view.php

### Error Pages (4)
- [ ] resources/views/errors/403.php
- [ ] resources/views/errors/404.php
- [ ] resources/views/errors/500.php
- [ ] resources/views/errors/503.php

**Note**: Error pages don't need navigation/footer, but should still use layout.

## QUICK CONVERSION STEPS

For each file:

1. **Extract title** from `<title>` tag
2. **Remove** everything before `<body>` tag
3. **Remove** everything after `</body>` tag  
4. **Remove** navigation and footer includes
5. **Add** PHP layout pattern (see template above)
6. **Convert** Bootstrap classes to Tailwind (for dashboards)
7. **Test** the page loads correctly

## VERIFICATION

After conversion, check:
- ✓ No `<!DOCTYPE html>` in file
- ✓ No `<script src="https://cdn.tailwindcss.com">`
- ✓ No `tailwind.config = {` inline config
- ✓ Has `ob_start()` at top
- ✓ Has `ob_get_clean()` at bottom
- ✓ Has `include __DIR__ . '/../layouts/main.php';`
- ✓ No Bootstrap class names (for dashboards)
- ✓ Page loads without errors

## BENEFITS AFTER COMPLETION

1. **Single source of truth** - All HTML structure in one place
2. **No duplication** - Metadata, CSS, JS defined once
3. **Consistent styling** - All pages use same Tailwind config
4. **Easy maintenance** - Update navigation/footer in one file
5. **Better performance** - Compiled CSS instead of runtime CDN
6. **No version conflicts** - One Tailwind version for all pages

## CURRENT PROGRESS

```
████████████░░░░░░░░░░░░░░░░ 38% (11/29)
```

Remaining work: 18 files to convert

