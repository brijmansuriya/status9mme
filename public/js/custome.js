function createSlug(string) {
    return string
        .toLowerCase()
        .trim()
        .replace(/[^a-zA-Z0-9-]+/g, "-");
}
