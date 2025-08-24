Studiova Merge Notes
====================

Base project:  Studiova-Full(1)
Overlay from:  studiova-payments

Strategy:
  - Started from the FULL project as canonical.
  - Overlaid files from the PAYMENTS project.
  - When a file path conflicted and contents differed, the FULL version was kept in-place,
    and the PAYMENTS version was saved next to it with a '._payments' suffix.
  - This lets you review differences without losing any content.

Next steps you may want to do:
  1) Compare any conflicted files listed below and manually reconcile logic (often config.php, routes, or templates).
  2) Update any environment variables or API keys as needed (e.g., payment gateways).
  3) Deploy to a PHP server and test checkout flow.
  4) Remove the '._payments' duplicate copies after merging differences.

Conflicted files (0 total):
  - None
